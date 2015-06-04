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

// Checkout
Route::group(['prefix' => 'checkout'], function() {
    Route::get('/', ['as' => 'checkout', 'uses' => 'CheckoutController@index']);
    Route::post('/', ['as' => 'checkout', 'uses' => 'CheckoutController@postCustomer']);
    Route::get('shipping', ['as' => 'checkout.shipping', 'uses' => 'CheckoutController@shipping']);
    Route::post('shipping', ['as' => 'checkout.shipping', 'uses' => 'CheckoutController@postShipping']);
    Route::get('billing', ['as' => 'checkout.billing', 'uses' => 'CheckoutController@billing']);
    Route::post('billing', ['as' => 'checkout.billing', 'uses' => 'CheckoutController@postBilling']);
    Route::get('confirm', ['as' => 'checkout.confirm', 'uses' => 'CheckoutController@confirm']);
});

// Admin
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function() {
    Route::get('/', ['as' => 'admin.dashboard', 'uses' => 'DashboardController@index']);
    Route::resource('products', 'ProductsController');
    Route::resource('collections', 'CollectionsController');
    Route::resource('orders', 'OrdersController');
});
