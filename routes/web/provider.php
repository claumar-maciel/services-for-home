<?php

use App\Http\Controllers\Provider\HomeController;
use App\Http\Controllers\Provider\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Provider Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'home'])->name('home');