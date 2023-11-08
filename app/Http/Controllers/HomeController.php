<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $events = $user->events; // ユーザーが参加中のイベントを取得
        return view('home', compact('events'));
    }
}
