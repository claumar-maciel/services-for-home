<?php

namespace App\Http\Controllers\Client;

use App\Helpers\StringHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Client\RegisterRequest;
use App\Models\Contato;
use App\Models\Endereco;
use App\Models\Perfil;
use App\Models\Usuario;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

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
        try {
            DB::beginTransaction();

            $request['celular'] = StringHelper::somenteNumeros($request->celular);
            $request['telefone_residencial'] = StringHelper::somenteNumeros($request->telefone_residencial);
            $dadosDoContato = array_merge(
                $request->only('celular', 'telefone_residencial')
            );
            $contato = Contato::create($dadosDoContato);
        
            $request['cep'] = StringHelper::somenteNumeros($request->cep);
            $dadosDoEndereco = array_merge(
                $request->only('rua', 'numero', 'bairro', 'cidade', 'estado', 'cep', 'ponto_referencia', 'complemento')
            );
            $endereco = Endereco::create($dadosDoEndereco);
    
            $request['password'] = Hash::make($request->senha);
            $request['cpf'] = StringHelper::somenteNumeros($request->cpf);
            $dadosDoUsuario = array_merge(
                $request->only('email', 'password', 'nome', 'cpf', 'username'), 
                [ 
                    'perfil_id' => Perfil::CLIENTE,
                    'endereco_id' => $endereco->id, 
                    'contato_id' => $contato->id, 
                ]
            );

            $usuario = Usuario::create($dadosDoUsuario);
            
            DB::commit();

            if ($usuario) {
                Session::flash('success','cadastro realizado com sucesso!'); 
        
                return redirect()->route('client.login');
            }
        } catch (\Exception $e) {
            DB::rollback();
            
            return back()->with('error','ocorreu um erro ao efetuar o cadastro!');
        }
    }

    public function doLogin()
    {
        return view('client.login');
    }
}
