<?php

namespace Quincalla\Http\Presenters;

use Laracasts\Presenter\Presenter;

class ProductPresenter extends Presenter
{
    public function format_price()
    {
        if ($this->compare_price < $this->price) {
            return '$'.number_format($this->compare_price, 2) 
                . ' <span class="scratch">$'
                . number_format($this->price, 2) 
                . '</span>';
        } else {
            return '$'.number_format($this->price, 2);
        }
    }
}

