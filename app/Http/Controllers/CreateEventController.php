<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CreateEventController extends Controller
{
    public function index()
    {
        return view('create-event');
    }
}
