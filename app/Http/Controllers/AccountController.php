<?php

namespace Quincalla\Http\Controllers;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('account');
    }
}
