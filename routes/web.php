<?php

use Illuminate\Support\Facades\Route;



Route::get('/', 'TestController@welcome');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


