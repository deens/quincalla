<?php
namespace Quincalla\Http\Controllers\Admin;

use Quincalla\Entities\Collection;
use Quincalla\Http\Requests;
use Quincalla\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CollectionsController extends Controller 
{
    protected $collections;

    public function __construct(Collection $collections)
    {
        $this->collections = $collections;
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
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
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

}


