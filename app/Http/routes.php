<?php

// Store
Route::get('/', 'HomeController@index');
Route::get('collections/{slug}', ['as' => 'collections.show', 'uses' => 'CollectionsController@show']);
Route::get('products/{slug}', ['as' => 'products.show', 'uses' => 'ProductsController@show']);
Route::resource('cart', 'CartController', ['except' => ['create', 'edit']]);
Route::get('search', ['as' => 'search.index', 'uses' => 'SearchController@index']);

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
