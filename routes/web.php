<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');


Route::get('/masuk', [AuthController::class, 'login'])->name('login');
Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
Route::get('/daftar', [AuthController::class, 'register'])->name('register');
Route::post('/store', [AuthController::class, 'store'])->name('store-register');

Route::middleware('auth')->group(function () {
    Route::get('/keluar', [AuthController::class, 'logout'])->name('logout');

    Route::get('/beranda', [DashboardController::class, 'homepage'])->name('homepage');
});


