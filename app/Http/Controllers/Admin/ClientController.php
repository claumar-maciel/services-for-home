<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\StringHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Client\UpdateRequest;
use App\Models\Perfil;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $clients = Usuario::search($request->only('search'))    
                            ->where('perfil_id', Perfil::CLIENTE)
                            ->paginate(6);

        $context = array_merge(
            $request->only('search'),
            ['clients' => $clients]
        );

        return view('admin.clients.index', $context);
    }

    public function edit(Usuario $client)
    {
        if ($client->perfil_id != Perfil::CLIENTE) {
            Session::flash('error','Você tentou acessar um usuário que não é cliente!'); 
            return redirect()->route('admin.home');
        }

        return view('admin.clients.edit', [
            'client' => $client
        ]);
    }

    public function update(Usuario $client, UpdateRequest $request)
    {
        if ($client->perfil_id != Perfil::CLIENTE) {
            Session::flash('error','Você tentou acessar um usuário que não é cliente!'); 
            return redirect()->route('admin.home');
        }

        try {
            DB::beginTransaction();

            $request['celular'] = StringHelper::somenteNumeros($request->celular);
            $request['telefone_residencial'] = StringHelper::somenteNumeros($request->telefone_residencial);
            $dadosDoContato = array_merge(
                $request->only('celular', 'telefone_residencial')
            );
            $client->contato()->update($dadosDoContato);
        
            $request['cep'] = StringHelper::somenteNumeros($request->cep);
            $dadosDoEndereco = array_merge(
                $request->only('rua', 'numero', 'bairro', 'cidade', 'estado', 'cep', 'ponto_referencia', 'complemento')
            );
            $client->endereco()->update($dadosDoEndereco);
    
            if (isset($request['senha']) && !empty($request['senha'])) {
                $request['password'] = Hash::make($request->senha);
            }
            $request['cpf'] = StringHelper::somenteNumeros($request->cpf);
            $dadosDoUsuario = $request->only('email', 'password', 'nome', 'cpf', 'username');

            $client->update($dadosDoUsuario);
            
            DB::commit();

            Session::flash('success','cliente atualizado com sucesso!'); 
            return redirect()->route('admin.clients');
        } catch (\Exception $e) {
            DB::rollback();
            
            return redirect()->route('admin.clients');
        }
    }

    public function destroy(Usuario $client)
    {
        if ($client->delete()) {
            Session::flash('success','cliente removido com sucesso!'); 
            return redirect()->route('admin.clients');
        }

        Session::flash('error','ocorreu um erro ao remover o cliente!');
        return redirect()->route('admin.clients');
    }
}
