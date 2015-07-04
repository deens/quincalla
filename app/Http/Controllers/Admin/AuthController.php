<?php
namespace Quincalla\Http\Controllers\Admin;

use Quincalla\Http\Requests;
use Quincalla\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller {

    public function login()
    {
        return view('admin.login');
    }
}

