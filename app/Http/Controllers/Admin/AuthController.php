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

    public function postLogin(Request $request)
    {
        $credentials = [
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'role' => 'admin',
            'active' => true
        ];

        if ( ! \Auth::attempt($credentials, $request->has('remember'))) {
            return redirect()->back()->with('error', 'Invalid email or password');
        }

        return redirect('/admin/products');
    }
}

