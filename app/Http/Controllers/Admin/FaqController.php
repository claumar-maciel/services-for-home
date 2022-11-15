<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

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

        return view('admin.faqs.index', $context);
    }

    public function create()
    {
        return view('admin.faqs.create');
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            Faq::create($request->only(['question', 'answer']));
            
            DB::commit();

            Session::flash('success','FAQ criado com sucesso!'); 
            return redirect()->route('admin.faqs');
        } catch (\Exception $e) {
            DB::rollback();
            
            Session::flash('error','ocorreu um erro ao criar o FAQ!'); 
            return redirect()->route('admin.faqs');
        }
    }

    public function edit(Faq $faq)
    {
        return view('admin.faqs.edit', [
            'faq' => $faq
        ]);
    }

    public function update(Faq $faq, Request $request)
    {
        try {
            DB::beginTransaction();

            $faq->update($request->only(['question', 'answer']));
            
            DB::commit();

            Session::flash('success','FAQ atualizado com sucesso!'); 
            return redirect()->route('admin.faqs');
        } catch (\Exception $e) {
            DB::rollback();
            
            Session::flash('error','ocorreu um erro ao atualizar o FAQ!'); 
            return redirect()->route('admin.faqs');
        }
    }

    public function destroy(Faq $faq)
    {
        try {
            DB::beginTransaction();

            $faq->delete();
            
            DB::commit();

            Session::flash('success','FAQ deletado com sucesso!'); 
            return redirect()->route('admin.faqs');
        } catch (\Exception $e) {
            DB::rollback();
            
            Session::flash('error','ocorreu um erro ao deletar o FAQ!'); 
            return redirect()->route('admin.faqs');
        }
    }
}
