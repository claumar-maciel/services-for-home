<?php

namespace App\Http\Controllers\Provider;

use App\Helpers\StringHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\Provider\RegisterRequest;
use App\Models\Contato;
use App\Models\Endereco;
use App\Models\Perfil;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function login()
    {
        return view('provider.login');
    }

    public function create()
    {
        return view('provider.create');
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
                    'perfil_id' => Perfil::PRESTADOR,
                    'endereco_id' => $endereco->id, 
                    'contato_id' => $contato->id, 
                ]
            );

            $usuario = Usuario::create($dadosDoUsuario);
            
            DB::commit();

            if ($usuario) {
                Session::flash('success','cadastro realizado com sucesso!'); 
        
                return redirect()->route('provider.login');
            }
        } catch (\Exception $e) {
            DB::rollback();
            
            return back()->with('error','ocorreu um erro ao efetuar o cadastro!');
        }
    }

    public function doLogin(Request $request)
    {
        if ($usuario = Usuario::where('email', $request->email)->where('perfil_id', Perfil::PRESTADOR)->first()) {
            if (Hash::check($request->senha, $usuario->password)) {
                Auth::guard('provider')->login($usuario);

                Session::flash('success','login efetuado com sucesso!'); 
                return redirect()->route('provider.home');
            }            
        }

        Session::flash('error','não foi possível efetuar o login, verifique os dados informados'); 
        return redirect()->route('provider.login');
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        
        Session::flash('success','logout efetuado com sucesso'); 
        return redirect()->route('provider.login');
    }

    public function home()
    {
        return view('provider.home');
    }

    public function profileEdit()
    {
        return view('provider.profile');
    }

    public function profileUpdate(ProfileUpdateRequest $request)
    {
        $provider = auth()->user();

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

            Session::flash('success','perfil atualizado com sucesso!'); 
            return redirect()->route('provider.profile');
        } catch (\Exception $e) {
            DB::rollback();
            
            Session::flash('success','ocorreu um erro ao atualizar o perfil!'); 
            return redirect()->route('provider.profile');
        }
    }
}
