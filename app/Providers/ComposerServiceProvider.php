<?php namespace Quincalla\Providers;

use View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer([
            'home',
            'collection',
            'product',
            'search',
            'cart'
        ], 'Quincalla\Http\ViewComposers\CollectionComposer');
        
        View::composer([
            'home',
            'collection',
            'product',
            'search',
            'cart',
            'checkout'
        ], 'Quincalla\Http\ViewComposers\CartComposer');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

}
