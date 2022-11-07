<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangeSchedulingStatusRequest;
use App\Models\Scheduling;
use App\Models\SchedulingStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SchedulingController extends Controller
{
    public function index(Request $request)
    {
        $schedulings = Scheduling::where('client_id', auth()->user()->id);

        if ($request->scheduling_status_id) {
            $schedulings = $schedulings->where('scheduling_status_id', $request->scheduling_status_id);
        }
        
        return view('client.schedulings.index',[
            'schedulings' => $schedulings->paginate(8),
            'scheduling_status_id' => $request->scheduling_status_id ?? null

        ]);
    }

    public function show(Scheduling $scheduling)
    {        
        return view('client.schedulings.show',[
            'scheduling' => $scheduling
        ]);
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
            return redirect()->route('client.schedulings.index');
        } catch (\Exception $e) {
            DB::rollback();
            
            Session::flash('error', 'erro ao atualizado o agendamento!'); 
            return redirect()->back();
        }
    }
}
