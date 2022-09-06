<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Perfil;
use App\Models\Usuario;
use Illuminate\Http\Request;
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
}
