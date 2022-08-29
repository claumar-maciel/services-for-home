<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Http\Requests\Provider\RegisterRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login()
    {
        return view('provider.login');
    }

    public function create()
    {
        return view('provider.create');
    }

    public function register(RegisterRequest $request)
    {
        dd($request->all());
    }
}
