<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserRegisterRequest;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login',[
            'title' => 'Masuk'
        ]);
    }

    public function register()
    {
        return view('auth.register',[
            'title' => 'Daftar'
        ]);
    }

    public function store(UserRegisterRequest $request)
    {
        try {
            $data = $request->validated();
            $data['username'] = str_replace(' ', '', strtolower($data['username']));
            User::create($data);
            return redirect()->route('login')->with('success', 'Pendaftaran berhasil, silahkan login');
        } catch (\Throwable $th) {
            Log::error($th);
            return redirect()->back()->with('error', 'Pendaftaran gagal');
        }
    }

    public function authenticate(Request $request)
    {
        if (Auth::attempt($request->only('username', 'password'))) {
            User::where('username', $request->username)->update(['isActive' => true]);
            return redirect()->route('homepage');
        }
        return redirect()->route('login')->with('error', 'Nama pengguna atau password tidak cocok');
    }

    public function logout()
    {
        User::where('username', Auth::user()->username)->update(['isActive' => false]);
        Auth::logout();
        return redirect()->route('login')->with('success', 'Keluar berhasil !');
    }
}
