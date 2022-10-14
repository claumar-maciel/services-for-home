<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Service\StoreRequest;
use App\Http\Requests\Service\UpdateRequest as ServiceUpdateRequest;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $services = Service::search($request->only('search'))
                            ->paginate(6);

        $context = array_merge(
            $request->only('search'),
            ['services' => $services]
        );

        return view('admin.services.index', $context);
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Service $service, StoreRequest $request)
    {
        try {
            DB::beginTransaction();

            $service->create($request->only(['description']));
            
            DB::commit();

            Session::flash('success','serviço criado com sucesso!'); 
            return redirect()->route('admin.services');
        } catch (\Exception $e) {
            DB::rollback();
            
            Session::flash('error','ocorreu um erro ao criar o serviço!'); 
            return redirect()->route('admin.services');
        }
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', [
            'service' => $service
        ]);
    }

    public function update(Service $service, ServiceUpdateRequest $request)
    {
        try {
            DB::beginTransaction();

            $service->update($request->only(['description']));
            
            DB::commit();

            Session::flash('success','serviço atualizado com sucesso!'); 
            return redirect()->route('admin.services');
        } catch (\Exception $e) {
            DB::rollback();
            
            Session::flash('error','ocorreu um erro ao atualizar o serviço!'); 
            return redirect()->route('admin.services');
        }
    }

    public function destroy(Service $service)
    {
        if ($service->delete()) {
            Session::flash('success','serviço removido com sucesso!'); 
            return redirect()->route('admin.services');
        }

        Session::flash('error','ocorreu um erro ao remover o serviço!');
        return redirect()->route('admin.services');
    }
}
