<?php

namespace Quincalla\Http\Controllers\Admin;

use Quincalla\Entities\Product;
use Quincalla\Entities\Collection;
use Quincalla\Entities\Tag;
use Quincalla\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    protected $products;
    protected $collections;
    protected $tags;

    public function __construct(Product $products, Collection $collections, Tag $tags)
    {
        $this->middleware('auth.admin');
        $this->products = $products;
        $this->collections = $collections;
        $this->tags = $tags;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $products = $this->products->paginate(15);

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $collections = $this->collections->getArrayListManualPublished();
        $tags = $this->tags->lists('name', 'id');

        return view('admin.products.create', compact('collections', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $product = $this->products->create($request->all());
        $this->tags->syncProductTags($product, $request->input('tags'));

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product has been created');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $product = $this->products->with('collections')->findOrFail($id);
        $collections = $this->collections->getArrayListManualPublished();
        $tags = $this->tags->lists('name', 'id');

        return view('admin.products.edit', compact('product', 'collections', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $product = $this->products->findOrFail($id);
        $product->update($request->all());

        $this->tags->syncProductTags($product, $request->input('tags'));

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}
