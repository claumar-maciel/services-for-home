<?php

use App\Http\Controllers\Admin\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [LoginController::class, 'login'])->name('login');
Route::get('/create', [LoginController::class, 'create'])->name('create');
Route::post('/register', [LoginController::class, 'register'])->name('register');