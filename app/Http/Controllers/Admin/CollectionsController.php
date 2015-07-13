<?php
namespace Quincalla\Http\Controllers\Admin;

use Quincalla\Entities\Collection;
use Quincalla\Entities\Product;
use Quincalla\Http\Requests;
use Quincalla\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CollectionsController extends Controller
{
    protected $collections;

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

        return view('admin.collections.create', compact('rulesColumns', 'rulesRelations'));
	}

	/**
	 * Store a newly created resource in storage.
     *
	 * @param Illuminate\Http\Request
	 * @return Response
	 */
	public function store(Request $request)
	{
        if ($request->get('type') === 'condition') {
            $rules = $this->splitRules($request->get('rules'));
            $request->merge(['rules' => json_encode($rules)]);
        }

        $collection = $this->collections->create($request->all());

        return redirect()->route('admin.collections.show', [$collection->id]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $collection = $this->collections->findOrFail($id);
        $products = $collection->products;

        return view('admin.collections.show', 
            compact('collection', 'products')
        );
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $collection = $this->collections->findOrFail($id);
        $rulesColumns = $this->products->getRulesColumns();
        $rulesRelations = $this->products->getRulesRelations();

        return view('admin.collections.edit', 
            compact('collection', 'rulesColumns', 'rulesRelations')
        );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
        dd($request->all());
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

    /**
     * Split multiple rules in to individual
     *
     * @param array $rules
     * @return array
     */
    private function splitRules($rules)
    {
        if (count($rules) > 3) {
            return (array_chunk($rules, 3));
        }
        return $rules;
    }
}
