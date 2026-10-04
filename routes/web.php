<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
Use App\Http\Controllers\AuthController;

// Auth
Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


// Master routes
Route::middleware(['auth', 'master'])->group(function (){
    Route::get('/admin/users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/admin', [UserController::class, 'admIndex'])->name('admin.index');
    Route::get('/admin/users', [UserController::class, 'userIndex'])->name('admin.users.index');
});

// User routes
Route::middleware(['auth'])->group(function (){
    Route::get('/dashboard', function () {
        return view('main.dashboard');
    })->name('dashboard');
});
