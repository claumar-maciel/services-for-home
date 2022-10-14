<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $services = Service::search($request->only('search'))->get();
        $currentServices = auth()->guard('provider')->user()->services;

        $context = array_merge(
            $request->only('search'),
            [
                'services' => $services,
                'currentServices' => $currentServices,
            ]
        );

        return view('provider.services.index', $context);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            auth()->guard('provider')->user()->services;

            if ($request->submit_button == 'adicionar') {
                $this->addServices($request->services ?? []);
            }

            if ($request->submit_button == 'remover') {
                $this->removeServices($request->services ?? []);
            }
            
            DB::commit();

            Session::flash('success','serviços atualizados com sucesso!'); 
            return redirect()->route('provider.services');
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
            Session::flash('error','ocorreu um erro ao atualizar os serviços!'); 
            return redirect()->route('provider.services');
        }
    }

    private function addServices(array $servces = [])
    {
        $provider = Usuario::where('id', auth()->guard('provider')->user()->id)->firstOrFail();

        foreach ($servces as $serviceId) {
            if (!$provider->services()->where('service_id', $serviceId)->count()) {
                $provider->services()->attach($serviceId);
            }
        }
    }

    private function removeServices(array $servces = [])
    {
        $provider = Usuario::where('id', auth()->guard('provider')->user()->id)->firstOrFail();

        foreach ($servces as $serviceId) {
            if ($provider->services()->where('service_id', $serviceId)->count()) {
                $provider->services()->detach($serviceId);
            }
        }
    }
}
