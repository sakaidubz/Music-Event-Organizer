<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;


class CreateEventController extends Controller
{
    public function index()
    {
        return view('create-event');
    }
    
    public function store(Request $request)
    {
        $data = $request->validate([
            'event.name' => 'required',
            'event.start_date' => 'required|date',
            'event.start_time' => 'required',
            'event.end_date' => 'required|date',
            'event.end_time' => 'required',
            'event.venue' => 'required',
            'event.address' => 'required'
            ]);
        
        Event::create([
            'name' => $data['event']['name'],
            'start_date' => $data['event']['start_date'],
            'start_time' => $data['event']['start_time'],
            'end_date' => $data['event']['end_date'],
            'end_time' => $data['event']['end_time'],
            'venue' => $data['event']['venue'],
            'address' => $data['event']['address']
        ]);

            
        return redirect()->route('home');
    }
}
