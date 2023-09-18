<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventEditorController extends Controller
{
    public function index()
    {
        return view('event-editor');
    }
}
