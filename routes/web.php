<?php

use Illuminate\Support\Facades\Route;



Route::get('/', 'TestController@welcome');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/products/{id}','ProductController@show'); 

Route::post('/cart', 'CartDetailController@store');
Route::delete('/cart', 'CartDetailController@destroy');

Route::post('/order','CartController@update');


Route::middleware(['auth','admin'])->prefix('admin')->namespace('Admin')->group(function(){

	//el primer argumento es el path
	//el segundo argumento indica a que método se llamará cuando se llame a esa ruta. en el primer caso ProductController.php

	Route::get('/products','ProductController@index'); //listado de productos

	Route::get('/products/create','ProductController@create'); //mostrar formulario creación de productos

	Route::post('/products','ProductController@store'); //registrar producto 

	Route::get('/products/{id}/edit','ProductController@edit'); //mostrar formulario edición de productos

	Route::post('/products/{id}/edit','ProductController@update'); //actualizar producto 

	Route::delete('/products/{id}','ProductController@destroy'); //eliminar producto

	

	Route::get('/products/{id}/images', 'ImageController@index');// listado de imágenes

	Route::post('/products/{id}/images', 'ImageController@store');// introducir imagen

	Route::delete('/products/{id}/images', 'ImageController@destroy'); //eliminar imagen

	Route::get('/products/{id}/images/select/{image}', 'ImageController@select'); //destacar imagen

});

