<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangeSchedulingStatusRequest;
use App\Http\Requests\Provider\StoreSchedulingRequest;
use App\Models\Chat;
use App\Models\Scheduling;
use App\Models\SchedulingStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SchedulingController extends Controller
{
    public function index(Request $request)
    {
        $schedulings = Scheduling::where('provider_id', auth()->user()->id);

        if ($request->scheduling_status_id) {
            $schedulings = $schedulings->where('scheduling_status_id', $request->scheduling_status_id);
        }
        
        return view('provider.schedulings.index',[
            'schedulings' => $schedulings->paginate(8),
            'scheduling_status_id' => $request->scheduling_status_id ?? null
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
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            
            Session::flash('error','erro ao criar o agendamento!'); 
            return redirect()->back();
        }
    }

    public function changeStatus(ChangeSchedulingStatusRequest $request, Scheduling $scheduling)
    {
        try {
            DB::beginTransaction();

            if ($request->scheduling_status_id == SchedulingStatus::FINISHED) {
                $scheduling->end_event = \Carbon\Carbon::now()->toDateTimeString();
            }
            
            $scheduling->scheduling_status_id = $request->scheduling_status_id;
            $scheduling->save();

            DB::commit();

            Session::flash('success', 'agendamento atualizado com sucesso!'); 
            return redirect()->route('provider.schedulings.index');
        } catch (\Exception $e) {
            DB::rollback();
            
            Session::flash('error', 'erro ao atualizado o agendamento!'); 
            return redirect()->back();
        }
    }
}
