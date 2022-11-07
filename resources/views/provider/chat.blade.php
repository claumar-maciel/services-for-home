@extends('layouts.provider.panel')
 
@section('title', 'Chat')
 
@section('content')
<div class="container mt-4">
    <div class="container d-flex justify-content-end align-items-center">
        <a href="#" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            <i class="bi bi-clock"></i> agendar serviço
        </a>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"><i class="bi bi-clock"></i> Criar Agendamento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('provider.chats.scheduling.store', ['chat' => $chat->id]) }}" method="POST">
                    @csrf

                    <div class="modal-body container my-2">
                        <div class="mb-3">
                            @include('shared.error_success_alert')
                        </div>

                        <div class="form-group mb-3">
                            <label for="title">Título</label>
                            <input type="text" name="title" placeholder="descreva o serviço prestado (máx: 45 letras)" class="form-control">
                        </div>

                        <div class="form-group mb-3">
                            <label for="date">Dia</label>
                            <input type="date" name="date" class="form-control">
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="hour">Horário</label>
                            <input type="time" name="hour" class="form-control">
                        </div>
    
                        <div class="alert alert-secondary">
                            Aqui você vai poder enviar uma proposta de horário de atendimento para o cliente. 
                            Quando o cliente aceitar, o agendamento vai ser enviada para os seus serviços em andamento até que o serviço seja finalizado, ou cancelado.
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">cancelar</button>
                        <button type="submit" class="btn btn-dark">criar</button>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>


    <div class="my-4 px-2" id="chat-content"
        style="
            max-height: 480px; 
            overflow: auto;
        ">
        <livewire:client.chat :chat="$chat"/>
    </div>

    <form class="w-100" action="{{ route('provider.chats.storeMessage', ['chat' => $chat->id]) }}" method="POST">
        @csrf
        
        <textarea name="content" id="" class="form-control" style="height: 120px;" placeholder="escreva a sua mensagem aqui"></textarea>
        
        <button class="btn btn-primary btn-block w-100 mt-1"><i class="bi bi-send"></i> Enviar</button>
    </form>
</div>
@endsection

@section('footerScripts')
    <script defer>
        window.addEventListener('DOMContentLoaded', (event) => {
            document.getElementById('chat-content').scrollTo(0, document.getElementById('chat-content').scrollHeight)
        })
    </script>
@endsection