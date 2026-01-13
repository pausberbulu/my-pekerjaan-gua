<?php

namespace App\Http\Controllers;

use App\Models\Workspace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function homepage()
    {
        $workspace = Workspace::where('owner_id', Auth::user()->id)->count();
        return view('dashboard.homepage', compact('workspace'));
    }
}
