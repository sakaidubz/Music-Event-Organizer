<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CostManagerController extends Controller
{
    public function index()
    {
        return view('cost-manager');
    }
}
