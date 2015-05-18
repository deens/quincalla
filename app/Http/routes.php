<?php

Route::get('/', 'WelcomeController@index');
Route::get('category', function() {
    return view('category');
});

Route::get('product', function() {
    return view('product');
});

Route::get('cart', function() {
    return view('cart');
});

Route::get('home', 'HomeController@index');


Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
