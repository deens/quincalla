<?php

namespace Quincalla\Http\Presenters;

use Laracasts\Presenter\Presenter;

class ProductPresenter extends Presenter
{
    public function format_price()
    {
        return '$'.number_format($this->price, 2);
    }

}

