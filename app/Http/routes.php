<?php

// Store
Route::get('/', 'HomeController@index');
Route::get('collections/{slug}', ['as' => 'collections.show', 'uses' => 'CollectionsController@show']);
Route::get('products/{slug}', ['as' => 'products.show', 'uses' => 'ProductsController@show']);

Route::get('cart/{id}/remove', ['as' => 'cart.remove', 'uses' => 'CartController@remove']);
Route::get('cart/destroy', ['as' => 'cart.destroy', 'uses' => 'CartController@destroy']);
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
    Route::get('/', ['as' => 'checkout.index', 'uses' => 'CheckoutController@index']);
    Route::get('customer', ['as' => 'checkout.customer', 'uses' => 'CheckoutController@customer']);
    Route::post('customer', ['as' => 'checkout.customer', 'uses' => 'CheckoutController@postCustomer']);
    Route::get('shipping', ['as' => 'checkout.shipping', 'uses' => 'CheckoutController@shipping']);
    Route::post('shipping', ['as' => 'checkout.shipping', 'uses' => 'CheckoutController@postShipping']);
    Route::get('billing', ['as' => 'checkout.billing', 'uses' => 'CheckoutController@billing']);
    Route::post('billing', ['as' => 'checkout.billing', 'uses' => 'CheckoutController@postBilling']);
    Route::get('confirm', ['as' => 'checkout.confirm', 'uses' => 'CheckoutController@confirm']);
});

// Admin
Route::get('admin/login', ['as' => 'admin.login', 'uses' => 'Admin\AuthController@login']);
Route::post('admin/login', ['as' => 'admin.login', 'uses' => 'Admin\AuthController@postLogin']);
Route::get('admin/logout', ['as' => 'admin.logout', 'uses' => 'Admin\AuthController@getLogout']);
Route::group(['prefix' => 'admin', 'middleware' => 'auth.admin', 'namespace' => 'Admin'], function() {
    Route::get('/', ['as' => 'admin.dashboard', 'uses' => 'DashboardController@index']);
    Route::resource('products', 'ProductsController', ['except' => ['show']]);
    Route::resource('collections', 'CollectionsController');
    Route::resource('orders', 'OrdersController');
    Route::resource('customers', 'CustomersController');

    Route::get('admin/settings/general', ['as' => 'admin.settings.general', 'uses' => 'SettingsController@general']);
    Route::post('admin/settings/general', ['as' => 'admin.settings.general', 'uses' => 'SettingsController@postGeneral']);
    Route::get('admin/settings/payment', ['as' => 'admin.settings.payments', 'uses' => 'SettingsController@payment']);
    Route::post('admin/settings/payment', ['as' => 'admin.settings.payments', 'uses' => 'SettingsController@postPayment']);
});

Route::get('collection', function()
{
    $collection = Quincalla\Entities\Collection::find(2);
    $products = new Quincalla\Entities\Product();

    $match = $collection->condition;
    $rules = $collection->rules;

    $result = $products->getByRules($match, $rules);
    foreach($result as $product)
    {
        var_dump($product->toArray());
    }
});
