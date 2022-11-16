<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

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

        return view('admin.posts.index', $context);
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $post = Post::create($request->only(['title', 'content']));

            if ($request->banner) {
                $path = $request->banner->store("img/posts/{$post->id}/", 'public');
                $post->update([
                    'banner' => $path
                ]);
            }

            DB::commit();

            Session::flash('success','post criado com sucesso!'); 
            return redirect()->route('admin.posts.index');
        } catch (\Exception $e) {
            DB::rollback();
            
            Session::flash('error','ocorreu um erro ao criar o post!'); 
            return redirect()->route('admin.posts.index');
        }
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', [
            'post' => $post
        ]);
    }

    public function update(Post $post, Request $request)
    {
        try {
            DB::beginTransaction();

            $post->update($request->only(['title', 'content']));

            if ($request->banner) {
                Storage::disk('public')->delete($post->banner);

                $path = $request->banner->store("img/posts/{$post->id}/", 'public');
                $post->update([
                    'banner' => $path
                ]);
            }
            
            DB::commit();

            Session::flash('success','post atualizado com sucesso!'); 
            return redirect()->route('admin.posts.index');
        } catch (\Exception $e) {
            DB::rollback();
            
            Session::flash('error','ocorreu um erro ao atualizar o post!'); 
            return redirect()->route('admin.posts.index');
        }
    }

    public function destroy(Post $post)
    {
        try {
            DB::beginTransaction();

            Storage::disk('public')->delete($post->banner);
            $post->delete();
            
            DB::commit();

            Session::flash('success','post deletado com sucesso!'); 
            return redirect()->route('admin.posts.index');
        } catch (\Exception $e) {
            DB::rollback();
            
            Session::flash('error','ocorreu um erro ao deletar o post!'); 
            return redirect()->route('admin.posts.index');
        }
    }
}
