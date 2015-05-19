<?php namespace Quincalla\Http\Controllers;

use Quincalla\Http\Requests;
use Quincalla\Http\Controllers\Controller;

use Illuminate\Http\Request;

class AccountController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index()
	{
		return view('account');
	}
}
