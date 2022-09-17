<?php

namespace App\Http\Controllers\Client;

use App\Helpers\StringHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePassRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\Client\RegisterRequest;
use App\Http\Requests\RecoverPassRequest;
use App\Http\Traits\RecoverPassTrait;
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
    use RecoverPassTrait;

    public function recoverPassForm()
    {
        return view('client.recover-pass-form');
    }

    public function changePassForm(Request $request)
    {
        return view('client.change-pass-form', [
            'recovery_code' => $request->code
        ]);
    }
    
    public function changePass(ChangePassRequest $request)
    {
        $usuario = Usuario::where('recovery_code', $request->recovery_code)->firstOrFail();

        $usuario->password = Hash::make($request->senha);
        $usuario->save();

        Session::flash('success','senha atualizada com sucesso!'); 
        return redirect()->route('client.login');
    }
    
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

    public function doLogin(Request $request)
    {
        if ($usuario = Usuario::where('email', $request->email)->where('perfil_id', Perfil::CLIENTE)->first()) {
            if (Hash::check($request->senha, $usuario->password)) {
                Auth::guard('client')->login($usuario);

                Session::flash('success','login efetuado com sucesso!'); 
                return redirect()->route('client.home');
            }            
        }

        Session::flash('error','não foi possível efetuar o login, verifique os dados informados'); 
        return redirect()->route('client.login');
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        
        Session::flash('success','logout efetuado com sucesso'); 
        return redirect()->route('welcome');
    }

    public function home()
    {
        return view('client.home');
    }

    public function profileEdit()
    {
        return view('client.profile');
    }

    public function profileUpdate(ProfileUpdateRequest $request)
    {
        $client = auth()->user();

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

            Session::flash('success','perfil atualizado com sucesso!'); 
            return redirect()->route('client.profile');
        } catch (\Exception $e) {
            DB::rollback();
            
            Session::flash('success','ocorreu um erro ao atualizar o perfil!'); 
            return redirect()->route('client.profile');
        }
    }
}
