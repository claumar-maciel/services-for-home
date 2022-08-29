<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\RegisterRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login()
    {
        return view('client.login');
    }

    public function create()
    {
        return view('client.create');
    }

    public function register(RegisterRequest $request)
    {
        dd($request->all());
    }
}
