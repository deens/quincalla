<?php

namespace Quincalla\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Quincalla\Entities\Collection;
use Quincalla\Entities\Product;
use Quincalla\Http\Controllers\Controller;

class CollectionsController extends Controller
{
    /**
     * @var Quincalla\Entities\Collection
     */
    protected $collections;
    /**
     * @var Quincalla\Entities\Product
     */
    protected $products;

    public function __construct(Collection $collections, Product $products)
    {
        $this->collections = $collections;
        $this->products = $products;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $collections = $this->collections->paginate(15);

        return view('admin.collections.index', compact('collections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $rulesColumns = $this->products->getRulesColumns();
        $rulesRelations = $this->products->getRulesRelations();
        $sortOptions = $this->products->getRulesSortOptions();

        return view('admin.collections.create',
            compact('rulesColumns', 'rulesRelations', 'sortOptions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Illuminate\Http\Request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        if ($request->get('type') === 'condition') {
            $rules = $this->splitRules($request->get('rules'));
            $request->merge(['rules' => $rules]);
        }

        $collection = $this->collections->create($request->all());

        return redirect()->route('admin.collections.edit', [$collection->id]);
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
        $collection = $this->collections->findOrFail($id);
        $rulesColumns = $this->products->getRulesColumns();
        $rulesRelations = $this->products->getRulesRelations();
        $sortOptions = $this->products->getRulesSortOptions();

        if ($collection->type === 'manual') {
            $products = $collection->products;
        } else {
            $products = $this->products->getByRules(
                $collection->match,
                $collection->rules,
                $collection->sort_order
                );
        }

        return view('admin.collections.edit',
            compact(
                'collection',
                'rulesColumns',
                'rulesRelations',
                'sortOptions',
                'products'
            )
        );
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
        $collection = $this->collections->findOrFail($id);

        if ($request->get('type') === 'condition') {
            $rules = $this->splitRules($request->get('rules'));
            $request->merge(['rules' => $rules]);
        }

        $collection->update($request->all());

        return redirect()->route('admin.collections.edit', [$collection->id]);
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

    /**
     * Split multiple rules in to individual.
     *
     * @param array $rules
     *
     * @return array
     */
    private function splitRules($rules)
    {
        if (count($rules) > 3) {
            return array_chunk($rules, 3);
        }

        return $rules;
    }
}
