<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\StringHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Provider\UpdateRequest;
use App\Models\Perfil;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ProviderController extends Controller
{
    public function index(Request $request)
    {
        $providers = Usuario::search($request->only('search'), false)    
                            ->where('perfil_id', Perfil::PRESTADOR)
                            ->paginate(6);

        $context = array_merge(
            $request->only('search'),
            ['providers' => $providers]
        );

        return view('admin.providers.index', $context);
    }

    public function edit(Usuario $provider)
    {
        if ($provider->perfil_id != Perfil::PRESTADOR) {
            Session::flash('error','Você tentou acessar um usuário que não é prestador!'); 
            return redirect()->route('admin.home');
        }

        return view('admin.providers.edit', [
            'provider' => $provider
        ]);
    }

    public function update(Usuario $provider, UpdateRequest $request)
    {
        if ($provider->perfil_id != Perfil::PRESTADOR) {
            Session::flash('error','Você tentou acessar um usuário que não é prestador!'); 
            return redirect()->route('admin.home');
        }

        try {
            DB::beginTransaction();

            $request['celular'] = StringHelper::somenteNumeros($request->celular);
            $request['telefone_residencial'] = StringHelper::somenteNumeros($request->telefone_residencial);
            $dadosDoContato = array_merge(
                $request->only('celular', 'telefone_residencial')
            );
            $provider->contato()->update($dadosDoContato);
        
            $request['cep'] = StringHelper::somenteNumeros($request->cep);
            $dadosDoEndereco = array_merge(
                $request->only('rua', 'numero', 'bairro', 'cidade', 'estado', 'cep', 'ponto_referencia', 'complemento')
            );
            $provider->endereco()->update($dadosDoEndereco);
    
            if (isset($request['senha']) && !empty($request['senha'])) {
                $request['password'] = Hash::make($request->senha);
            }
            $request['cpf'] = StringHelper::somenteNumeros($request->cpf);
            $dadosDoUsuario = $request->only('email', 'password', 'nome', 'cpf', 'username');

            $provider->update($dadosDoUsuario);
            
            DB::commit();

            Session::flash('success','prestador atualizado com sucesso!'); 
            return redirect()->route('admin.providers');
        } catch (\Exception $e) {
            DB::rollback();
            
            Session::flash('error','ocorreu um erro ao atualizar o prestador!'); 
            return redirect()->route('admin.providers');
        }
    }

    public function destroy(Usuario $provider)
    {
        if ($provider->delete()) {
            Session::flash('success','prestador removido com sucesso!'); 
            return redirect()->route('admin.providers');
        }

        Session::flash('error','ocorreu um erro ao remover o prestador!');
        return redirect()->route('admin.providers');
    }
}
