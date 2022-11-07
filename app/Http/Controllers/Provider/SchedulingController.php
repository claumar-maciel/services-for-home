<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Http\Requests\Provider\StoreSchedulingRequest;
use App\Models\Chat;
use App\Models\Scheduling;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SchedulingController extends Controller
{
    public function index()
    {
        $schedulings = Scheduling::where('provider_id', auth()->user()->id)->paginate(8);
        
        return view('provider.schedulings.index',[
            'schedulings' => $schedulings
        ]);
    }

    public function show(Scheduling $scheduling)
    {        
        return view('provider.schedulings.show',[
            'scheduling' => $scheduling
        ]);
    }

    public function store(StoreSchedulingRequest $request, Chat $chat)
    {
        $dateToString = "{$request->date} {$request->hour}";

        try {
            DB::beginTransaction();
            
            Scheduling::create([
                'title' => $request->title,
                'start_event' => $dateToString,
                'chat_id' => $chat->id,
                'client_id' => $chat->client_id,
                'provider_id' => $chat->provider_id,
            ]);
            
            DB::commit();

            Session::flash('success','agendamento criado com sucesso!'); 
            return redirect()->route('provider.schedulings.index');
        } catch (\Exception $e) {
            DB::rollback();
            
            Session::flash('error','erro ao criar o agendamento!'); 
            return redirect()->back();
        }
    }
}
