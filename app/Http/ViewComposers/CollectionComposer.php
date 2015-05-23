<?php 

namespace Quincalla\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Quincalla\Collection;

class CollectionComposer
{

    public function compose(View $view)
    {
        $view->with('collections', Collection::all());
    }
}
