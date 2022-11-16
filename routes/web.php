<?php

use App\Http\Controllers\FaqController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|---------------------------------------------------------------------------|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');