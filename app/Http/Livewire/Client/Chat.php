<?php

namespace App\Http\Livewire\Client;

use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Chat extends Component
{
    public $chat;
    public $messages;

    public function render()
    {
        $this->messages = $this->chat->messages;
        
        return view('livewire.client.chat');
    }
    
    public function refreshMessages()
    {
        $this->messages = [];
    }
}
