<?php

use Quincalla\Entities\Collection;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CollectionTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_should_return_only_published_collections()
    {
        $numOfCollections = 10;
        factory(Quincalla\Entities\Collection::class, $numOfCollections)->create([
            'published' => true,
        ]);

        $collections = Collection::published()->get();

        $this->assertEquals($numOfCollections, $collections->count());
    }

    /** @test */
    public function it_should_return_empty_when_unpublished()
    {
        $numOfCollections = 2;
        factory(Quincalla\Entities\Collection::class, $numOfCollections)->create([
            'published' => false,
        ]);

        $collections = Collection::published()->get();

        $this->assertEquals(0, $collections->count());
    }
}

