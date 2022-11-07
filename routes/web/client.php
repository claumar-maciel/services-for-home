<?php

use App\Http\Controllers\Client\ChatController;
use App\Http\Controllers\Client\GeolocationController;
use App\Http\Controllers\Client\HelpController;
use App\Http\Controllers\Client\LoginController;
use App\Http\Controllers\Client\ProviderController;
use App\Http\Controllers\Client\SchedulingController;
use Illuminate\Http\Request;
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
Route::get('/recover-pass-form', [LoginController::class, 'recoverPassForm'])->name('recover-pass-form');
Route::post('/recover-pass', [LoginController::class, 'recoverPass'])->name('recover-pass');
Route::get('/change-pass-form', [LoginController::class, 'changePassForm'])->name('change-pass-form');
Route::post('/change-pass', [LoginController::class, 'changePass'])->name('change-pass');

Route::group([
    'middleware' => 'auth:client'
], function () {
    Route::get('/panel', [LoginController::class, 'home'])->name('home');

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/profile', [LoginController::class, 'profileEdit'])->name('profile');
    Route::put('/profile', [LoginController::class, 'profileUpdate'])->name('profile.update');

    Route::get('/providers', [ProviderController::class, 'index'])->name('providers');
    Route::get('/providers/{providerId}', [ProviderController::class, 'show'])->name('providers.show');
    Route::post('/providers/{provider}/chat', [ChatController::class, 'store'])->name('providers.openChat');

    Route::get('chats', [ChatController::class, 'index'])->name('chats.index');
    Route::get('chats/{provider}/open-chat', [ChatController::class, 'store'])->name('chats.store');
    Route::get('chats/{chat}', [ChatController::class, 'show'])->name('chats.show');
    Route::post('chats/{chat}/messages', [ChatController::class, 'storeMessage'])->name('chats.storeMessage');

    Route::get('/help-center', [HelpController::class, 'index'])->name('help-center');

    Route::post('/geolocation', [GeolocationController::class, 'store'])->name('geolocation.store');

    Route::get('schedulings', [SchedulingController::class, 'index'])->name('schedulings.index');
    Route::get('schedulings/{scheduling}', [SchedulingController::class, 'show'])->name('schedulings.show');
    Route::patch('schedulings/{scheduling}/change-status', [SchedulingController::class, 'changeStatus'])->name('schedulings.changeStatus');
});