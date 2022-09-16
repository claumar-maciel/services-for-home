<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

class HelpController extends Controller
{
    public function index()
    {
        return view('client.help-center');
    }
}
