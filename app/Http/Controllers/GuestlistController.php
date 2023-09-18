<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuestlistController extends Controller
{
    public function index()
    {
        return view('guestlist');
    }
}
