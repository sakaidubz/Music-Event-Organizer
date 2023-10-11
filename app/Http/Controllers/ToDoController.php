<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class ToDoController extends Controller
{
    public function index()
    {
        $events = Auth::user()->events()->with('todos')->get();
        return view('to-do', compact('events'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'description' => 'required',
        ]);
        
        $todo = new Todo();
        $todo->event_id = $request->event_id;
        $todo->description = $request->description;
        $todo->status = false;
        $todo->save();
        
        return redirect()->route('to-do')->with('success', 'ToDoが追加されました。');
    }
    
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|boolean',
        ]);
        
        $todo = Todo::find($id);
        $todo->status = $request->status;
        $todo->save();
        
        return redirect()->route('to-do')->with('success', 'Todoのステータスが変更されました。');
    }
    
    public function destroy($id)
    {
        $todo = Todo::find($id);
        $todo->delete();
        
        return redirect()->route('to-do')->with('success', 'ToDoが削除されました。');
    }
}
