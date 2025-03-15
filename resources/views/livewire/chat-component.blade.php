<div>
    <div class="mb-4 overflow-y-auto h-96" id="chat-messages">
        @foreach ($messages as $message)
        <div class="mb-2 @if ($message->user_id === Auth::id()) text-right @endif">
            <div
                class="inline-block p-2 rounded-lg @if ($message->user_id === Auth::id()) bg-blue-500 text-white @else bg-gray-200 dark:bg-gray-700 @endif">
                {{ $message->message }}
                <div class="text-xs mt-1 @if ($message->user_id === Auth::id()) text-right @endif">
                    {{ $message->user->name }} - {{ $message->created_at->diffForHumans() }}
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <form wire:submit.prevent="sendMessage">
        <div class="flex">
            <input type="text" wire:model.defer="messageText"
                class="flex-grow px-4 py-2 border border-gray-300 rounded-l-md dark:border-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Escribe tu mensaje...">
            <button type="submit"
                class="px-4 py-2 font-bold text-white bg-blue-500 hover:bg-blue-700 rounded-r-md focus:outline-none focus:ring-2 focus:ring-blue-500">Enviar</button>
        </div>
        @error('messageText')
        <span class="text-red-500">{{ $message }}</span>
        @enderror
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
    function scrollToBottom() {
        let chatMessages = document.getElementById('chat-messages');
        if (chatMessages) {
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }
    }

    // Ejecutar al iniciar
    scrollToBottom();

    // Escuchar el evento de Livewire
    Livewire.on('scroll-to-bottom', () => {
        setTimeout(scrollToBottom, 100); // Da un pequeño retraso para asegurar que el DOM se haya actualizado
    });
});

    </script>
</div>