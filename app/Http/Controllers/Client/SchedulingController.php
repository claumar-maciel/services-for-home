<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Scheduling;

class SchedulingController extends Controller
{
    public function index()
    {
        $schedulings = Scheduling::where('client_id', auth()->user()->id)->paginate(8);
        
        return view('client.schedulings.index',[
            'schedulings' => $schedulings
        ]);
    }

    public function show(Scheduling $scheduling)
    {        
        return view('client.schedulings.show',[
            'scheduling' => $scheduling
        ]);
    }
}
