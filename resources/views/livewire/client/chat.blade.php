<div>
    @if (count($messages))
        @foreach ($messages as $message)
            @if (auth()->user()->id != $message->sender->id)
                <div class="w-100 d-flex justify-content-start mb-2">
                    <div class="card w-75">
                        <div class="card-body">
                            <p class="m-0 text-bold">{{ $message->content }}</p>
    
                            <div class="d-flex justify-content-end">
                                <span class="text-muted" style="font-size: 12px;">{{ $message->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="w-100 d-flex justify-content-end mb-2">
                    <div class="card w-75 bg-secondary text-white">
                        <div class="card-body">
                            <p class="m-0 text-bold">{{ $message->content }}</p>
                            
                            <div class="d-flex justify-content-end">
                                <span class="m-0 text-white" style="font-size: 12px;">{{ $message->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
    
        @endforeach
    @else
        <div class="alert alert-light">Ainda não foi enviada nenhuma mensagem!</div>
    @endif
</div>

<script defer>
    document.addEventListener('livewire:load', function () {
        let channel = window.Echo.channel('chat');
        channel.listen('.chat-changed', function(data) {
            @this.refreshMessages()
                    .then(() => {
                        document.getElementById('chat-content').scrollTo(0, document.getElementById('chat-content').scrollHeight)
                    })
        });
    })
</script>