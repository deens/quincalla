<?php
namespace Quincalla\Tests\Functional;

use Quincalla\Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CollectionTest extends TestCase
{

    public function testCollectionPage()
    {
        $this->visit('/collections/necklaces')
            ->see('Necklaces');
    }

    public function testVisibleProducts()
    {
        $this->visit('/collections/necklaces')
            ->see('First Necklace Yellow Gold')
            ->click('First Necklace Yellow Gold')
            ->seePageIs('/products/first-necklace-yellow-gold')
            ->see('First Necklace Yellow Gold');
    }

    public function testCollectionsNavigationLinks()
    {
        $this->visit('/collections/necklaces')
            ->see('Collections')
            ->see('Necklaces')
            ->see('Pendants')
            ->see('Rings')
            ->see('Bracelets')
            ->see('Earrings')
            ->click('Earrings')
            ->seePageIs('/collections/earrings')
            ->see('Earrings');
    }

    public function testPaginationLinks()
    {
        $this->visit('/collections/necklaces')
            ->see('&laquo')
            ->see('&raquo')
            ->click('»')
            ->seePageIs('/collections/necklaces?page=2')
            ->click('«')
            ->seePageIs('/collections/necklaces?page=1');
    }
}
