<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::search($request->only('search'))    
                            ->paginate(6);

        $context = array_merge(
            $request->only('search'),
            ['posts' => $posts]
        );

        return view('client.posts', $context);
    }
}
