<?php
namespace Quincalla\Http\Controllers;

use Quincalla\Entities\Collection;
use Quincalla\Entities\Product;

class HomeController extends Controller
{
    protected $products;

    public function __construct(Product $products)
    {
        $this->products = $products;
    }

    public function index()
    {
        $products = $this->products
            ->published()
            ->orderBy('created_at', 'desc')
            ->take(8)
            ->get();

        return view('home', compact('products'));
    }
}
