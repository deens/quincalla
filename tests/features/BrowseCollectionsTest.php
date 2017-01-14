<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BrowseCollectionsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function user_should_be_able_to_navigate_to_a_collection_page()
    {
        $collection = factory(Quincalla\Entities\Collection::class)->create();

        $this->visit('/collections/' . $collection->slug)
            ->see($collection->name);
    }

    /** @test */
    public function user_should_receive_404_on_unpiblished_collection()
    {
        $collection = factory(Quincalla\Entities\Collection::class)->create([
            'published' => false,
        ]);

        $response = $this->call('GET', '/collections/'. $collection->slug);

        $this->assertEquals(404, $response->status());
    }

    /** @test */
    public function user_should_see_available_products_on_collection()
    {
        $collection = factory(Quincalla\Entities\Collection::class)->create([
            'name' => 'Electronics',
            'slug' => 'electronics',
        ]);
        $products = factory(Quincalla\Entities\Product::class, 6)->create();
        $collection->products()->saveMany($products);

        $this->assertEquals(6, $collection->products()->count());

        $this->visit('/collections/' . $collection->slug)
            ->see($products->first()->name)
            ->see($products->last()->name);
    }

    /** @test */
    public function user_should_only_see_six_products_per_page()
    {
        $collection = factory(Quincalla\Entities\Collection::class)->create();
        $products = factory(Quincalla\Entities\Product::class, 12)->create();
        $collection->products()->saveMany($products);

        $this->assertEquals(12, $collection->products()->count());

        $this->visit('/collections/' . $collection->slug)
            ->see($products->first()->name)
            ->see($products[5]->name)
            ->dontSee($products->last()->name);
    }

    /** @test */
   public function user_should_not_see_unpublished_products_on_a_collection()
    {
        $collection = factory(Quincalla\Entities\Collection::class)->create();
        $products = factory(Quincalla\Entities\Product::class, 12)->create([
            'published' => false,
        ]);
        $collection->products()->saveMany($products);

        $this->visit('/collections/' . $collection->slug)
            ->see('Not Products Found');
    }
}
