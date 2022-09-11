<?php

use App\Http\Controllers\Provider\ChatController;
use App\Http\Controllers\Provider\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Provider Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [LoginController::class, 'login'])->name('login');
Route::get('/create', [LoginController::class, 'create'])->name('create');
Route::post('/register', [LoginController::class, 'register'])->name('register');
Route::post('/login', [LoginController::class, 'doLogin'])->name('doLogin');

Route::group([
    'middleware' => 'auth:provider'
], function () {
    Route::get('/panel', [LoginController::class, 'home'])->name('home');

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/profile', [LoginController::class, 'profileEdit'])->name('profile');
    Route::put('/profile', [LoginController::class, 'profileUpdate'])->name('profile.update');


    Route::get('chats', [ChatController::class, 'index'])->name('chats.index');
    Route::get('chats/{chat}', [ChatController::class, 'show'])->name('chats.show');
    Route::post('chats/{chat}/messages', [ChatController::class, 'storeMessage'])->name('chats.storeMessage');
});