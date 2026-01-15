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
        $joinedWorkspace = Auth::user()->members()->count();
        $sumWorkspace = $workspace + $joinedWorkspace;

        $getWorkspace = Workspace::count();
        $tasks = Auth::user()->tasks()->get();

        return view('dashboard.homepage', compact('sumWorkspace', 'getWorkspace', 'tasks'));
    }
}
