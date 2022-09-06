<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Perfil;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function home()
    {
        return view('admin.home');
    }
}
