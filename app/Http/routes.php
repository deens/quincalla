<?php

// Store
Route::get('/', 'HomeController@index');
Route::get('collections/{slug}', ['as' => 'collections.show', 'uses' => 'CollectionsController@show']);
Route::get('products/{slug}', ['as' => 'products.show', 'uses' => 'ProductsController@show']);

Route::get('cart/{id}/delete', ['as' => 'cart.destroy', 'uses' => 'CartController@destroy']);
Route::put('cart/update', ['as' => 'cart.update', 'uses' => 'CartController@update']);
Route::resource('cart', 'CartController', ['except' => ['create', 'update', 'edit', 'destroy']]);
Route::get('search', ['as' => 'search.index', 'uses' => 'SearchController@index']);
Route::get('checkout', ['as' => 'checkout', 'uses' => 'CheckoutController@index']);

// Account
Route::get('account', 'AccountController@index');

// Auth
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

// Admin
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function() {
    Route::get('/', ['as' => 'admin.dashboard', 'uses' => 'DashboardController@index']);
    Route::resource('products', 'ProductsController');
    Route::resource('collections', 'CollectionsController');
    Route::resource('orders', 'OrdersController');
});
