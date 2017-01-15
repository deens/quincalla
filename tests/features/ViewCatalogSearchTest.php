<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;

class ViewCatalogSearchTest extends TestCase
{

    use DatabaseMigrations;

    /** @test */
    public function user_should_see_search_results()
    {
        $product = factory(Quincalla\Entities\Product::class)->create([
            'name' => 'Example Product',
        ]);

        $this->visit('/')
            ->type('Example', 'query')
            ->press('Search')
            ->seePageIs('/search?query=Example')
            ->see('Example Product');
    }

    /** @test */
    public function user_should_not_see_search_results()
    {
        $this->visit('/')
            ->type('Example', 'query')
            ->press('Search')
            ->seePageIs('/search?query=Example')
            ->see('No Products Found');
    }

    /** @test */
    public function user_should_be_able_to_browse_pages_on_search_results()
    {
        $products = factory(Quincalla\Entities\Product::class, 20)->create([
            'name' => 'Example Product'
        ]);

        $this->visit('/')
            ->type('Example', 'query')
            ->press('Search')
            ->seePageIs('/search?query=Example')
            ->click('2')
            ->seePageIs('/search?page=2&query=Example');
    }
}
