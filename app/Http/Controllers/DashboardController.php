<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function homepage()
    {
        return view('dashboard.homepage');
    }
}
