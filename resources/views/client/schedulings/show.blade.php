@extends('layouts.client.panel')
 
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
                Você ainda não aceitou o agendamento
            </div>
        @endif

        @if ($scheduling->scheduling_status_id === \App\Models\SchedulingStatus::ACCEPTED)
            <div class="alert alert-warning mt-3">
                Você já aceitou o agendamento, agora basta aguardar a prestação do serviço. Quando o prestador confirmar a finalização do serviço, você vai poder avaliar o mesmo.
            </div>
        @endif

        <div class="my-4">
            <hr>
            <h5>Dados do Prestador</h5>
            <div class="d-flex align-items-center">
                <img src="{{ asset('img/man.png') }}" class="img-fluid rounded-start" width="120px">
    
                <div class="ms-2 p-2 text-muted">
                    <h5 class="card-title">{{ $scheduling->provider->nome }}</h5>
        
                    <h6 class="card-subtitle mb-2">{{ $scheduling->provider->email }}</h6>
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
            @if ($scheduling->scheduling_status_id === \App\Models\SchedulingStatus::CREATED)
                <form action="{{ route('client.schedulings.changeStatus', ['scheduling' => $scheduling->id]) }}" method="POST">
                    @csrf
                    @method('patch')

                    <input type="hidden" name="scheduling_status_id" value="{{ \App\Models\SchedulingStatus::ACCEPTED }}">

                    <button class="btn btn-primary">Confirmar agendamento</button>
                </form>
            @endif
        </div>
    </div>
@endsection