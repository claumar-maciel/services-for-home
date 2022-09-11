<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\StringHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
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
        return view('admin.login');
    }

    public function create()
    {
        return view('admin.create');
    }

    public function doLogin(Request $request)
    {
        if ($usuario = Usuario::where('email', $request->email)->where('perfil_id', Perfil::ADMINISTRADOR)->first()) {
            if (Hash::check($request->senha, $usuario->password)) {
                Auth::guard('admin')->login($usuario);

                Session::flash('success','login efetuado com sucesso!'); 
                return redirect()->route('admin.home');
            }            
        }

        Session::flash('error','não foi possível efetuar o login, verifique os dados informados'); 
        return redirect()->route('admin.login');
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        
        Session::flash('success','logout efetuado com sucesso'); 
        return redirect()->route('admin.login');
    }

    public function profileEdit()
    {
        return view('admin.profile');
    }

    public function profileUpdate(ProfileUpdateRequest $request)
    {
        $admin = auth()->user();

        try {
            DB::beginTransaction();

            $request['celular'] = StringHelper::somenteNumeros($request->celular);
            $request['telefone_residencial'] = StringHelper::somenteNumeros($request->telefone_residencial);
            $dadosDoContato = array_merge(
                $request->only('celular', 'telefone_residencial')
            );
            $admin->contato()->update($dadosDoContato);
        
            $request['cep'] = StringHelper::somenteNumeros($request->cep);
            $dadosDoEndereco = array_merge(
                $request->only('rua', 'numero', 'bairro', 'cidade', 'estado', 'cep', 'ponto_referencia', 'complemento')
            );
            $admin->endereco()->update($dadosDoEndereco);
    
            if (isset($request['senha']) && !empty($request['senha'])) {
                $request['password'] = Hash::make($request->senha);
            }
            $request['cpf'] = StringHelper::somenteNumeros($request->cpf);
            $dadosDoUsuario = $request->only('email', 'password', 'nome', 'cpf', 'username');

            $admin->update($dadosDoUsuario);
            
            DB::commit();

            Session::flash('success','perfil atualizado com sucesso!'); 
            return redirect()->route('admin.profile');
        } catch (\Exception $e) {
            DB::rollback();
            
            Session::flash('success','ocorreu um erro ao atualizar o perfil!'); 
            return redirect()->route('admin.profile');
        }
    }

    public function home()
    {
        return view('admin.home');
    }
}
