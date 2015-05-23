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
            'search'
        ], 'Quincalla\Http\ViewComposers\CollectionComposer');
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
