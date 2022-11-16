<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index(Request $request)
    {   
        $faqs = Faq::search($request->only('search'))
                            ->paginate(6);

        $context = array_merge(
            $request->only('search'),
            ['faqs' => $faqs]
        );

        return view('client.faqs', $context);
    }
}