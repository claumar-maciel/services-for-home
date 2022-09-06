<?php

use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'doLogin'])->name('doLogin');

Route::group([
    'middleware' => 'auth:admin'
], function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/panel', [LoginController::class, 'home'])->name('home');

    Route::get('/clients', [ClientController::class, 'index'])->name('clients');
    Route::get('/clients/{client}', [ClientController::class, 'edit'])->name('clients.edit');
});