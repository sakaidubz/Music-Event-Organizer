<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
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
        $event = auth()->user()->events()->find($event_id);
        if (!$event) {
            return redirect()->route('event-editor')->with('error', 'イベントが存在しないか、編集の権限がありません。');
        }
        
        // イベントに関連するユーザーを取得
        $participants = $event->users;
        
        // event, participantsをビューに渡す
        return view('event-editor-edit', compact('event', 'participants'));
    }

    public function update(Request $request, Event $event) 
    {

        if (!$event) {
            return redirect()->route('event-editor')->with('error', 'イベントが存在しないか、編集の権限がありません。');
        }
        
        // データのバリデーション
        $messages = [
            'name.required' => 'イベント名の欄は空欄ではいけません。',
            'start_date.required' => '開始日の欄は空欄ではいけません。',
            'start_time.required' => '開始時間の欄は空欄ではいけません。',
            'end_date.required' => '終了日の欄は空欄ではいけません。',
            'end_time.required' => '終了時間の欄は空欄ではいけません。',
            'venue.required' => '会場の欄は空欄ではいけません。',
            'address.required' => '住所の欄は空欄ではいけません。',
        ];
        
        $request->validate([
            'event.name' => 'required',
            'event.start_date' => 'required|date',
            'event.start_time' => 'required',
            'event.end_date' => 'required|date',
            'event.end_time' => 'required',
            'event.venue' => 'required',
            'event.address' => 'required',
        ], $messages);
        
        // データを更新
        $input = $request['event'];
        $event->fill($input)->save();
        
        return redirect()->route('event-editor.edit', $event->id)->with('success', 'イベントが更新されました。');
    }
    
    public function leave($eventId)
    {
        $user = auth()->user();
        $event = Event::find($eventId);
        
        if (!$event) {
            return redirect()->back()->with('error', 'イベントが存在しません。');
        }
        
        $user->events()->detach($eventId);
        
        return redirect()->route('profile')->with('success', 'イベントから退出しました。');
    }
    
    public function destroy($event_id)
    {
        $event = auth()->user()->events()->find($event_id);
        
        if(!$event) {
            return redirect()->route('event-editor')->with('error', 'イベントが存在しないか、削除の権限がありません。');
        }
        
        $event->delete(); // イベントを削除
        
        return redirect()->route('event-editor')->with('success', 'イベントが削除されました。');
    }
    
    public function addUser(Request $request, $event_id)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);
        
        $user = User::where('email', $request->email)->first();
        $event = Event::find($event_id);
        
        // 追加したいユーザーがすでにイベントに紐づいていないかの確認
        if($event->users()->where('user_id', $user->id)->exists()){
            return back()->withErrors('このユーザーは既にイベントに参加しています。');
        }
        
        $event->users()->attach($user->id);
        
        return back()->with('success', 'ユーザーがイベントに追加されました。');
    }
}
