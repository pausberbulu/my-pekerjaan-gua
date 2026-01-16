<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('ownedWorkspaces')->select('name','username','email','created_at','id')->get();
        return view('dashboard.user.user', compact('users'));
    }
}
