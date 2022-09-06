@extends('layouts.admin.panel')
 
@section('title', 'Clientes')
 
@section('content')
    <div class="w-100 mt-4 d-flex justify-content-center align-items-center flex-wrap">
        @foreach ($clients as $client)
            <div class="card m-3 p-2" style="max-width: 400px; min-width: 300px;">
                <div class="row g-0">
                    <div class="col-md-4 d-flex align-items-center">
                        <img src="{{ asset('img/man.png') }}" class="img-fluid rounded-start">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <a href="{{ route('admin.clients.edit', ['client' => $client->id]) }}" class="text-decoration-none text-dark">
                                <h5 class="card-title">{{ $client->nome }}</h5>
                            </a>
                            <h6 class="card-subtitle mb-2 text-muted">{{ $client->email }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center mt-4">
        {!! $clients->links() !!}
    </div>
@endsection