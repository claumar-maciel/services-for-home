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

        @if ($scheduling->scheduling_status_id === \App\Models\SchedulingStatus::FINISHED && is_null($scheduling->rating))
            <div class="alert alert-warning mt-3">
                O serviço foi finalizado, logo o cliente deve lhe avaliar ★.
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
                <span><b>Situação: </b>{{ $scheduling->status->description }}</span>

                @if (!is_null($scheduling->rating))
                    <br><span class="text-muted"><b>Nota: </b>{{ $scheduling->rating }}</span>
                @endif

                @if (!is_null($scheduling->client_comment))
                    <br><span class="text-muted"><b>Comentário: </b>{{ $scheduling->client_comment }}</span>
                @endif
            </div>

        </div>

        <div class="mt-4 d-flex justify-content-end">
            @if ($scheduling->scheduling_status_id === \App\Models\SchedulingStatus::ACCEPTED )
                <form action="{{ route('provider.schedulings.changeStatus', ['scheduling' => $scheduling->id]) }}" method="POST">
                    @csrf
                    @method('patch')

                    <input type="hidden" name="scheduling_status_id" value="{{ \App\Models\SchedulingStatus::IN_PROGRESS }}">

                    <button class="btn btn-primary">Começar Serviço</button>
                </form>
            @endif

            @if ($scheduling->scheduling_status_id === \App\Models\SchedulingStatus::IN_PROGRESS )
                <form action="{{ route('provider.schedulings.changeStatus', ['scheduling' => $scheduling->id]) }}" method="POST">
                    @csrf
                    @method('patch')

                    <input type="hidden" name="scheduling_status_id" value="{{ \App\Models\SchedulingStatus::FINISHED }}">

                    <button class="btn btn-primary">Finalizar Serviço</button>
                </form>
            @endif
        </div>
    </div>
@endsection