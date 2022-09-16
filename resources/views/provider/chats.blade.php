@extends('layouts.provider.panel')
 
@section('title', 'Chats')
 
@section('content')
    <div class="container mt-4">
        @include('shared.chat-list')
    </div>
@endsection