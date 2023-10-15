<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;
use App\Models\Event;

class AddPlanController extends Controller
{
    public function create()
    {
        $events = auth()->user()->events; // ログインユーザーが参加しているイベントを取得
        $plans = Plan::all(); // 仮表示のため
        return view('add-plan', compact('events', 'plans'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'description' => 'required',
            'date' => 'required|date',
        ]);
        
        Plan::create($request->all());
        
        return redirect()->route('add-plan.create')->with('success', '予定が追加されました。');
    }
    
    public function destroy($id)
    {
        Plan::findOrFail($id)->delete();
        return redirect()->route('calendar.index')->with('success', '予定が削除されました。');
    }
}
