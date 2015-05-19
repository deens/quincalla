<?php namespace Quincalla\Http\Controllers;

use Quincalla\Http\Requests;
use Quincalla\Http\Controllers\Controller;

use Illuminate\Http\Request;

class CartController extends Controller {

	public function index()
	{
        return view('cart');
	}

	public function store()
	{
        dd(\Request::all());
	}

	public function update($id)
	{
		//
	}

	public function destroy($id)
	{
		//
	}

}
