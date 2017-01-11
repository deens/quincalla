<?php

namespace Quincalla\Http\Presenters;

use Laracasts\Presenter\Presenter;

class ProductPresenter extends Presenter
{
    public function format_price()
    {
        if ( ! is_null($this->compare_price) && (int) $this->compare_price < (int) $this->price) {
            return '$'.number_format($this->compare_price / 100, 2)
                .' <span class="scratch">$'
                .number_format($this->price / 100, 2)
                .'</span>';
        } else {
            return '$'.number_format($this->price / 100, 2);
        }
    }
}
