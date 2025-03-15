<?php

namespace App\Livewire;

use App\Events\NewMessage;
use App\Models\Chat;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Livewire;

use function Illuminate\Log\log;

class ChatComponent extends Component
{

    public Chat $chat;
    public $messageText;
    public $messages;

    public function mount(Chat $chat)
    {
        $this->chat = $chat;
        $this->loadMessages();

        // Escucha el evento 'created' del modelo Message
        Message::created(function ($message) {
            if ($message->chat_id === $this->chat->id) {
                $this->loadMessages();
                Livewire::forceRender(); // Fuerza el re-renderizado del componente
            }
        });
    }

    public function loadMessages()
    {
        $this->messages = $this->chat->messages()->with('user')->get(); // No conviertas a array, usa la colección directamente

        $this->dispatch('scroll-to-bottom'); // Desplaza el scroll al final del chat
        $this->dispatch('$refresh');

    }

    public function sendMessage()
{
    // ... (código anterior)

    $newMessage = Message::create([ // Crea el mensaje
        'chat_id' => $this->chat->id,
        'user_id' => Auth::id(),
        'message' => $this->messageText,
    ]);

    $this->messageText = '';

    $newMessageArray = $newMessage->toArray(); // Convierte el nuevo mensaje a un array

    if (is_array($this->messages)) { // Verifica si $messages es un array
        $this->messages = array_merge($this->messages, [$newMessageArray]);
    } else {
      $this->messages = [$newMessageArray]; // Si no es un array, crea uno nuevo
    }

    log::info('New message sent');

    event(new NewMessage()); // Emite el evento NewMessage

    $this->loadMessages(); // Recarga los mensajes (esto actualiza la vista del chat actual)

}
    public function render()
    {
        return view('livewire.chat-component');
    }

    #[On('echo:global-chat,NewMessage')]
    public function handleNewMessage()
    {
        Log::info('New message received');
        $this->loadMessages();


    }
}