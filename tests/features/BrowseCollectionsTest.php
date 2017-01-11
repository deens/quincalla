<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BrowseCollectionsTest extends TestCase
{
    use DatabaseMigrations;

    public function user_should_see_homepage_collections()
    {
        $this->assertTrue(true);
    }

    /**
     * @test */
    public function user_should_be_able_to_navigate_to_a_collection_page()
    {
        $collection = factory(Quincalla\Entities\Collection::class)->create([
            'name' => 'apple',
            'slug' => 'apple',
        ]);

        $this->visit('/collections/' . $collection->slug)
            ->see($collection->name);
    }

    /** @test */
    public function user_should_receive_a_not_found_when_navigate_to_a_no_existing_collection()
    {
        $collection = factory(Quincalla\Entities\Collection::class)->create([
            'name' => 'apple',
            'slug' => 'apple',
            'published' => false,
        ]);

        $response = $this->call('GET', '/collections/'. $collection->slug);

        $this->assertEquals(404, $response->status());
    }
}
