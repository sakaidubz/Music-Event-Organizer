<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventEditorController extends Controller
{
    public function index() 
    {
        $user = auth()->user();
        $events = $user->events; // ユーザーが参加中のイベントを取得
        return view('event-editor', compact('events'));
    }
    
    public function edit($event_id) 
    {
        $event = Event::find($event_id);
        return view('event-editor-edit', compact('event'));
    }

    public function update(Request $request, $event_id) 
    {
        $event = Event::find($event_id);
        // データを更新
        // ...
        return redirect()->route('event-editor.edit', $event_id)->with('success', 'イベントが更新されました。');
    }
    
    public function leave()
    {
        $user = auth()->user();
        $event = Event::find($eventId);
        
        if (!$event) {
            return redirect()->back()->with('error', 'イベントが存在しません。');
        }
        
        $user->events()->detach($eventId);
        
        return redirect()->route('profile')->with('success', 'イベントから退出しました。');
    }
}
