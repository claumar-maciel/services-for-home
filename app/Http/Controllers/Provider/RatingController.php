<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\StoreRatingRequest;
use App\Models\Perfil;
use App\Models\Scheduling;
use App\Models\SchedulingImage;
use App\Models\Usuario;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class RatingController extends Controller
{
    public function rate(Scheduling $scheduling)
    {
        return view('client.schedulings.rate', [
            'scheduling' => $scheduling
        ]);
    }

    public function store(Scheduling $scheduling, StoreRatingRequest $request)
    {
        try {
            DB::beginTransaction();

            if ($request->images) {
                foreach ($scheduling->images as $image) {
                    Storage::disk('public')->delete($image->url);
                    $image->delete();
                }
            }

            foreach ($request->images ?? [] as $key => $image) {
                $path = $image->store("img/schedulings/{$scheduling->id}/", 'public');
    
                SchedulingImage::create([
                    'url' => $path,
                    'scheduling_id' => $scheduling->id
                ]);       
            }
            
            $scheduling->update($request->except('images'));

            DB::commit();

            Session::flash('success','avaliação enviada com sucesso!'); 
            return redirect()->route('client.schedulings.index');
        } catch (\Exception $e) {
            throw $e;
            DB::rollback();
            
            return back()->with('error','ocorreu um erro salvar a sua avaliação!');
        }
    }
}
