<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventEditorController extends Controller
{
    public function index()
    {
        return view('event-editor');
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
