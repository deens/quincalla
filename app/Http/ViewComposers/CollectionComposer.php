<?php

namespace Quincalla\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Quincalla\Entities\Collection;

class CollectionComposer
{
    public function compose(View $view)
    {
        $view->with('collections', Collection::published()->get());
    }
}
