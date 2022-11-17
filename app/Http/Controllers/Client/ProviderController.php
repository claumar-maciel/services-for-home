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

        $rating = $provider->schedulings()
                            ->selectRaw('AVG(rating) as amount, COUNT(rating) as qtd')
                            ->get()[0];      
                            
        $schedulingImages = $provider->select('scheduling_images.*')
                            ->join('schedulings', 'schedulings.provider_id', '=', 'usuarios.id')      
                            ->join('scheduling_images', 'scheduling_images.scheduling_id', '=', 'schedulings.id')
                            ->where('perfil_id', Perfil::PRESTADOR)
                            ->where('usuarios.id', $provider->id)
                            ->paginate(6);      

        return view('client.providers.show', [
            'provider' => $provider,
            'rating' => $rating->amount,
            'rating_qtd' => $rating->qtd,
            'scheduling_images' => $schedulingImages,
        ]);
    }
}
