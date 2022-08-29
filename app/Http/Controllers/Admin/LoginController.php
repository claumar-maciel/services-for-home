<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login()
    {
        return view('admin.login');
    }

    public function create()
    {
        return view('admin.create');
    }

    public function register(Request $request)
    {
        dd($request->all());
    }
}
