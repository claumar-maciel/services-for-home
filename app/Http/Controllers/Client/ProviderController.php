<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Perfil;
use App\Models\Usuario;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    public function index(Request $request)
    {
        $providers = Usuario::search($request->only('search'))    
                            ->where('perfil_id', Perfil::PRESTADOR)
                            ->paginate(6);

        $context = array_merge(
            $request->only('search'),
            ['providers' => $providers]
        );

        return view('client.providers.index', $context);
    }

    public function show(int $poviderId)
    {
        $provider = Usuario::where('perfil_id', Perfil::PRESTADOR)
                            ->findOrFail($poviderId);

        return view('client.providers.show', [
            'provider' => $provider
        ]);
    }
}
