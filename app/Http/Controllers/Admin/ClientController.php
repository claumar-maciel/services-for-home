<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Perfil;
use App\Models\Usuario;
use Illuminate\Support\Facades\Session;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Usuario::where('perfil_id', Perfil::CLIENTE)->paginate(6);

        return view('admin.clients.index', [
            'clients' => $clients
        ]);
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
}
