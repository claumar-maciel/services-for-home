<?php

use App\Http\Controllers\Client\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Client Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [LoginController::class, 'login'])->name('login');
Route::get('/create', [LoginController::class, 'create'])->name('create');
Route::post('/register', [LoginController::class, 'register'])->name('register');
Route::post('/login', [LoginController::class, 'doLogin'])->name('doLogin');

Route::group([
    'middleware' => 'auth:client'
], function () {
    Route::get('/panel', [LoginController::class, 'home'])->name('home');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});