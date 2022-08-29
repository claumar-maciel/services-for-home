@extends('layouts.auth')
 
@section('title', 'criar conta')
 
@section('content')
    <div class="container__auth">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-dark">Criar conta</h5>
                
                <p class="card-text">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form class="mt-4" action="{{route('admin.register')}}" method="POST">
                        @csrf
                        
                        <div class="form-group my-3">
                            <input type="email" class="form-control" placeholder="email">
                        </div>

                        <div class="form-group" class="form-group my-3">
                            <input type="password" class="form-control" placeholder="senha">
                        </div>

                        <div class="d-flex justify-content-end form-group my-3">
                            <a class="btn btn-secondary ms-2" href="{{ route('admin.login') }}">já tenho conta</a>
                            <button class="btn btn-primary ms-2">criar</button>
                        </div>
                    </form>
                </p>
            </div>
        </div>
    </div>
@endsection