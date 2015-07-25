<?php

namespace Quincalla\Tests\Functional;

use Quincalla\Tests\TestCase;

class SearchTest extends TestCase
{
    public function test_it_should_redirect_to_search()
    {
        $this->visit('/')
            ->type('Gold', 'query')
            ->press('Search');
        $this->seePageIs('/search?query=Gold');
    }

    public function test_it_should_return_not_products_found()
    {
        $this->visit('/')
            ->type('products-not-found-query', 'query')
            ->press('Search')
            ->see('Not Products Found');
    }

    public function test_it_should_return_products_with_pagination()
    {
        $query = 'a';
        $this->visit('/')
            ->type($query, 'query')
            ->press('Search')
            ->see('Search results for `'.$query.'`')
            ->see('&laquo')
            ->see('&raquo')
            ->click('»')
            ->seePageIs('/search?page=2&query='.$query)
            ->click('«')
            ->seePageIs('/search?page=1&query='.$query);
    }
}
