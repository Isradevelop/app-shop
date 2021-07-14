<?php

use Illuminate\Support\Facades\Route;



Route::get('/', 'TestController@welcome');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware(['auth','admin'])->prefix('admin')->group(function(){

	//CR

	Route::get('/products','ProductController@index'); //listado de productos

	Route::get('/products/create','ProductController@create'); //mostrar formulario creación de productos

	Route::post('/products','ProductController@store'); //registrar producto 

	Route::get('/products/{id}/edit','ProductController@edit'); //mostrar formulario edición de productos

	Route::post('/products/{id}/edit','ProductController@update'); //actualizar producto 

	Route::delete('/products/{id}','ProductController@destroy'); //eliminar

});

