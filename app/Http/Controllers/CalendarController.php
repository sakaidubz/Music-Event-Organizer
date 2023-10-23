<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Plan;

class CalendarController extends Controller
{
    public function index()
    {
        return view('calendar');
    }
    
    public function getPlans()
    {
        $plans = DB::table('plans')
            ->join('events', 'plans.event_id', '=', 'events.id')
            ->select('plans.event_id',
                     'plans.description',
                     'plans.start_date',
                     'plans.end_date',
                     'events.name as event_name',
                     'events.color as event_color')
            ->get();
            
        return response()->json($plans);
    }
    
    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ], [
            'title.required' => 'タイトルは必須です。',
            'description.required' => '内容は必須です。',
            'start_date.required' => '開始日は必須です。',
            'end_date.required' => '終了日は必須です。',
        ]);
        
        $data = $request->all();
        $data['end_date'] = date("Y-m-d", strtotime("{$request->input('end_date')} +1 day"));
        Plan::create($data);
        
        return redirect(route('calendar'));
    }
    
    public function get(Request $request, Plan $plan) {
        $request->validate([
            'start_date' => 'required|integer',
            'end_date' => 'required|integer',
        ]);
        
        $start_date = date('Y-m-d', $request->input('start_date') / 1000);
        $end_date = date('Y-m-d', $request->input('end_date') / 1000);
        
        return $plan->query()
            ->join('events', 'plans.event_id', '=', 'events.id')
            ->select(
                'plans.id',
                'plans.title',
                'plans.description',
                'plans.start_date as start',
                'plans.end_date as end',
                'events.color as backgroundColor',
                'events.color as borderColor',
            )
            
            ->where('plans.end_date', '>', $start_date)
            ->where('plans.start_date', '<', $end_date)
            ->get();
    }
    
    public function getUserEvents() {
        $user = auth()->user();
        $events = $user->events;
        return response()->json($events);
    }
    
    public function savePlan(Request $request) {
        $plan = new Plan();
        $plan->title = $request->title;
        $plan->start_date = $request->start_date;
        $plan->end_date = $request->end_date;
        $plan->description = $request->description;
        $plan->event_id = $request->event_id;
        
        $plan->save();
        return redirect()->back()->with('success', '予定が追加されました。');
    }
}
