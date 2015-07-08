<?php
namespace Quincalla\Tests\Functional;

use Quincalla\Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class HomePageTest extends TestCase
{

    public function testHomePage()
    {
        $this->visit('/')
            ->see('quincalla');
    }
}
