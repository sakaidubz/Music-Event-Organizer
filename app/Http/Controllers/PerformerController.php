<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Performer;
use App\Models\Event;
use Illuminate\Validation\Rule;

class PerformerController extends Controller
{
    public function store(Request $request, $event_id)
    {
        // バリデーションルールを定義
        $rules = [
            'event_id' => 'required|exists:events,id',
            'performer_name' => 'required|string|max:30',
            'contact_details' => 'required|string|max:50',
            'status' => 'required|in:picked,booking,booked',
            'start_time' => [
                'nullable',
                'date_format:H:i',
                Rule::unique('performers', 'start_time')
                    ->where(function ($query) use ($request, $event_id) {
                        return $query->where('event_id', $event_id)
                            ->where('id', '<>', $request->input('performer_id'));
                    }),
            ],
            'end_time' => [
                'nullable',
                'date_format:H:i',
                Rule::unique('performers', 'end_time')
                    ->where(function ($query) use ($request, $event_id) {
                        return $query->where('event_id', $event_id)
                            ->where('id', '<>', $request->input('performer_id'));
                    }),
            ],
        ];

        // バリデーション実行
        $request->validate($rules);

        // Performerモデルを使用してデータを保存
        Performer::create([
            'event_id' => $event_id,
            'performer_name' => $request->input('performer_name'),
            'contact_details' => $request->input('contact_details'),
            'status' => $request->input('status'),
            'start_time' => $request->input('start_time'),
            'end_time' => $request->input('end_time'),
        ]);

        return redirect()->route('event-editor.edit', ['event_id' => $event_id]);
    }
    
    // public function show($event_id)
    // {
    //     $event_id = Event::find($event_id);
    //     $performers = Performer::where('event_id', $event_id)->get(); // 出演者データを取得
    //     return view('event-editor-edit', compact('event_id', 'performers'));
    // }

}
