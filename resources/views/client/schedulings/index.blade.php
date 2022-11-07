@extends('layouts.client.panel')
 
@section('title', 'Agendamentos')
 
@section('content')
    <div class="w-100 mt-4 d-flex justify-content-center align-items-stretch flex-wrap">
        @if ($schedulings->count())
            @foreach ($schedulings as $scheduling)
                <div class="card m-3 p-2 d-flex flex-column justify-content-center" style="max-width: 400px; min-width: 300px;">
                    <div class="row g-0 d-flex align-items-center">
                        <div class="col-md-4 d-flex align-items-center justify-content-center">
                            <i class="bi bi-clock" style="font-size: 64px;"></i>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <a href="{{ route('provider.schedulings.show', ['scheduling' => $scheduling->id]) }}" class="text-decoration-none text-dark">
                                    <h5 class="card-title m-0">{{ $scheduling->title }}</h5>
                                </a>

                                <span class="text-muted mb-2">
                                    {{ Carbon\Carbon::parse($scheduling->start_event)->format('d/m/Y') }} às {{ Carbon\Carbon::parse($scheduling->start_event)->format('H:i') }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="row g-0 d-flex align-items-center my-3">
                        <div class="col-md-4 d-flex align-items-center">
                            <img src="{{ asset('img/man.png') }}" class="img-fluid rounded-start">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{ $scheduling->provider->nome }}</h5>

                                <h6 class="card-subtitle mb-2 text-muted">{{ $scheduling->provider->email }}</h6>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-light">
                        <b>Situação: </b>{{ $scheduling->status->description }}
                    </div>

                    <div class="w-100 d-flex justify-content-end align-items-center mt-1">
                        <a href="{{ route('client.schedulings.show', ['scheduling' => $scheduling->id]) }}" class="btn btn-primary btn-sm w-100">
                            ver agendamento
                        </a>
                    </div>
                </div>
            @endforeach
        @else
            <div class="alert alert-light mt-4">
                Nenhum agendamento encontrado!  
            </div>          
        @endif
    </div>

    <div class="d-flex justify-content-center mt-4">
        {!! $schedulings->links() !!}
    </div>
@endsection