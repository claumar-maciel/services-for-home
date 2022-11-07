<?php

use App\Http\Controllers\Provider\ChatController;
use App\Http\Controllers\Provider\GeolocationController;
use App\Http\Controllers\Provider\HelpController;
use App\Http\Controllers\Provider\LoginController;
use App\Http\Controllers\Provider\SchedulingController;
use App\Http\Controllers\Provider\ServiceController;
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
Route::get('/recover-pass-form', [LoginController::class, 'recoverPassForm'])->name('recover-pass-form');
Route::post('/recover-pass', [LoginController::class, 'recoverPass'])->name('recover-pass');
Route::get('/change-pass-form', [LoginController::class, 'changePassForm'])->name('change-pass-form');
Route::post('/change-pass', [LoginController::class, 'changePass'])->name('change-pass');

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
    Route::post('chats/{chat}/scheduling', [SchedulingController::class, 'store'])->name('chats.scheduling.store');
    
    Route::get('/help-center', [HelpController::class, 'index'])->name('help-center');
    
    Route::post('/geolocation', [GeolocationController::class, 'store'])->name('geolocation.store');
    
    Route::get('/services', [ServiceController::class, 'index'])->name('services');
    Route::post('/services', [ServiceController::class, 'store'])->name('services.store');

    Route::get('schedulings', [SchedulingController::class, 'index'])->name('schedulings.index');
    Route::get('schedulings/{scheduling}', [SchedulingController::class, 'show'])->name('schedulings.show');
    Route::patch('schedulings/{scheduling}/change-status', [SchedulingController::class, 'changeStatus'])->name('schedulings.changeStatus');
});