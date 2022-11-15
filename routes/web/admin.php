<?php

use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\ProviderController;
use App\Http\Controllers\Admin\ServiceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'doLogin'])->name('doLogin');
Route::get('/recover-pass-form', [LoginController::class, 'recoverPassForm'])->name('recover-pass-form');
Route::post('/recover-pass', [LoginController::class, 'recoverPass'])->name('recover-pass');
Route::get('/change-pass-form', [LoginController::class, 'changePassForm'])->name('change-pass-form');
Route::post('/change-pass', [LoginController::class, 'changePass'])->name('change-pass');

Route::group([
    'middleware' => 'auth:admin'
], function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/panel', [LoginController::class, 'home'])->name('home');
    Route::get('/profile', [LoginController::class, 'profileEdit'])->name('profile');
    Route::put('/profile', [LoginController::class, 'profileUpdate'])->name('profile.update');

    Route::get('/clients', [ClientController::class, 'index'])->name('clients');
    Route::get('/clients/{client}', [ClientController::class, 'edit'])->name('clients.edit');
    Route::put('/clients/{client}', [ClientController::class, 'update'])->name('clients.update');
    Route::delete('/clients/{client}', [ClientController::class, 'destroy'])->name('clients.destroy');

    Route::get('/providers', [ProviderController::class, 'index'])->name('providers');
    Route::get('/providers/{provider}', [ProviderController::class, 'edit'])->name('providers.edit');
    Route::put('/providers/{provider}', [ProviderController::class, 'update'])->name('providers.update');
    Route::delete('/providers/{provider}', [ProviderController::class, 'destroy'])->name('providers.destroy');

    Route::get('/services', [ServiceController::class, 'index'])->name('services');
    Route::get('/services/novo', [ServiceController::class, 'create'])->name('services.create');
    Route::post('/services/novo', [ServiceController::class, 'store'])->name('services.store');
    Route::get('/services/{service}', [ServiceController::class, 'edit'])->name('services.edit');
    Route::put('/services/{service}', [ServiceController::class, 'update'])->name('services.update');
    Route::delete('/services/{service}', [ServiceController::class, 'destroy'])->name('services.destroy');

    Route::get('/faqs', [FaqController::class, 'index'])->name('faqs');
    Route::get('/faqs/create', [FaqController::class, 'create'])->name('faqs.create');
    Route::post('/faqs/create', [FaqController::class, 'store'])->name('faqs.store');
    Route::get('/faqs/{faq}/edit', [FaqController::class, 'edit'])->name('faqs.edit');
    Route::put('/faqs/{faq}/edit', [FaqController::class, 'update'])->name('faqs.update');
    Route::delete('/faqs/{faq}/edit', [FaqController::class, 'destroy'])->name('faqs.destroy');
});