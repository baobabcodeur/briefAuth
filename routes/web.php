<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;

use Illuminate\Support\Facades\Route;


Route::get('/', [MainController::class, 'home'])->middleware(['auth', 'verified'])->name('home');

Route::get('/login', [MainController::class, 'index'])->name('login');
Route::get('/logout', [MainController::class, 'update'])->name('logout');
Route::get('/register', [MainController::class, 'register'])->name('register');

Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/registration', [AuthController::class, 'registration'])->name('registration.process');