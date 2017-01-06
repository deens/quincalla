<?php

namespace Quincalla\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Quincalla\Http\Controllers\Controller;

class SettingsController extends Controller
{
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
