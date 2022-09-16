<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;

class HelpController extends Controller
{
    public function index()
    {
        return view('provider.help-center');
    }
}
