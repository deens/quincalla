<?php

Route::get('/', 'HomeController@index');
Route::get('collections/{slug}', ['as' => 'collections.show', 'uses' => 'CollectionsController@show']);
Route::get('products/{slug}', ['as' => 'products.show', 'uses' => 'ProductsController@show']);
Route::resource('cart', 'CartController');

// Protected
Route::get('account', 'AccountController@index');


Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
