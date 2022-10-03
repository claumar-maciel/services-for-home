<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\GeolocationStoreRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class GeolocationController extends Controller
{
    public function store(GeolocationStoreRequest $request)
    {
        $geolocationData = $request->only(['latitude', 'longitude']);

        $client = auth()->user();
        
        try {
            DB::beginTransaction();
            
            $client->endereco()->update($geolocationData);
            
            DB::commit();

            Session::flash('success','geolocalização salva com sucesso!'); 
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            
            Session::flash('success','erro ao salvar os dados de localização!'); 
            return redirect()->back();
        }
    }
}
