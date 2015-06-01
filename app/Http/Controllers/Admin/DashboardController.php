<?php namespace Quincalla\Http\Controllers\Admin;

use Quincalla\Http\Requests;
use Quincalla\Http\Controllers\Controller;

use Illuminate\Http\Request;

class DashboardController extends Controller {

	public function index()
	{
        return view('admin.dashboard');
	}

}
