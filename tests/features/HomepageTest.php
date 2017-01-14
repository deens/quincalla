<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class HomepageTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function user_can_see_site_name()
    {
        $this->visit('/')
            ->see('quincalla');
    }
}
