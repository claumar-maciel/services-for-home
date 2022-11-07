@extends('layouts.provider.panel')
 
@section('title', $scheduling->title)
 
@section('content')
    <div>
        <h6 class="text-muted mb-2">
            <b>Data inicial: </b> 
            {{ 
                $scheduling->start_event
                ? Carbon\Carbon::parse($scheduling->start_event)->format('d/m/Y') . ' às ' . Carbon\Carbon::parse($scheduling->start_event)->format('H:i')
                : '-'
            }}
        </h6>
        <h6 class="text-muted mb-2">
            <b>Data final: </b> 
            {{ 
                $scheduling->end_event
                ? Carbon\Carbon::parse($scheduling->end_event)->format('d/m/Y') . ' às ' . Carbon\Carbon::parse($scheduling->end_event)->format('H:i')
                : '-'
            }}
        </h6>
        @if ($scheduling->scheduling_status_id === \App\Models\SchedulingStatus::CREATED)
            <div class="alert alert-warning mt-3">
                O cliente ainda não aceitou o seu agendamento
            </div>
        @endif

        <div class="my-4">
            <hr>
            <h5>Dados do Cliente</h5>
            <div class="d-flex align-items-center">
                <img src="{{ asset('img/man.png') }}" class="img-fluid rounded-start" width="120px">
    
                <div class="ms-2 p-2 text-muted">
                    <h5 class="card-title">{{ $scheduling->client->nome }}</h5>
        
                    <h6 class="card-subtitle mb-2">{{ $scheduling->client->email }}</h6>
                </div>
            </div>
            <hr>
        </div>

        <div class="my-4">
            <h5>Dados do Agendamento</h5>

            <div class="text-muted">
                <b>Situação: </b>{{ $scheduling->status->description }}
            </div>
        </div>

        <div class="mt-4 d-flex justify-content-end">
            <form action="">
                <button class="btn btn-primary" {{ $scheduling->scheduling_status_id !== \App\Models\SchedulingStatus::ACCEPTED ? 'disabled' : '' }}>Finalizar Serviço</button>
            </form>
        </div>
    </div>
@endsection