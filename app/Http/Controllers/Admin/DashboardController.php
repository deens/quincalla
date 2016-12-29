<?php

namespace Quincalla\Http\Controllers\Admin;

use Quincalla\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }
}
