<?php
namespace Quincalla\Http\Controllers\Admin;

use Quincalla\Http\Requests;
use Quincalla\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingsController extends Controller {

	public function general()
	{
        return view('admin.settings.general');
	}

    public function postGeneral(Request $request)
    {
        dd($request->all());
    }

	public function payment()
	{
        return view('admin.settings.payment');
	}

    public function postPayment(Request $request)
    {
        dd($request->all());
    }
}


