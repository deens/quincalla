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
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        return view('home', compact('products'));
    }
}
