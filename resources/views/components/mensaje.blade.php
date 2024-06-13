<div class="flex-1 bg-gray-200 flex flex-col h-full">
    <div class="flex justify-between items-center py-3 px-6 border-b border-gray-200">
        <div class="relative flex items-center space-x-4">
            <div class="relative">
                @if ($avatar)
                    <img src="{{ $avatar }}" alt="" class="w-10 sm:w-16 h-10 sm:h-16 rounded-full">
                @else
                    <img src="https://ui-avatars.com/api/?name={{ $initial }}&color=7F9CF5&background=EBF4FF"
                        alt="" class="w-10 sm:w-16 h-10 sm:h-16 rounded-full">
                @endif
            </div>
            <div class="flex flex-col leading-tight">
                <div class="text-2xl mt-1 flex items-center">
                    <span class="text-gray-700 mr-3">{{ $nombre }}</span>
                </div>
                <span class="text-lg text-gray-600">{{ $cargo }}</span>
            </div>
        </div>
    </div>
    @foreach($mensajes as $mensaje)
    @if(auth()->id() == $mensaje->emisor_id)
        <!-- Mensaje enviado (se muestra a la derecha) -->
        <div class="chat-message">
            <div class="flex items-end justify-end">
                <div class="flex flex-col space-y-2 text-xs max-w-xs mx-2 order-1 items-end">
                    <div>
                        <span class="px-4 py-2 rounded-lg inline-block rounded-br-none bg-blue-600 text-white">
                            {{ $mensaje->mensaje }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- Mensaje recibido (se muestra a la izquierda) -->
        <div class="chat-message">
            <div class="flex items-end">
                <div class="flex flex-col space-y-2 text-xs max-w-xs mx-2 order-2 items-start">
                    <div>
                        <span class="px-4 py-2 rounded-lg inline-block rounded-bl-none bg-gray-300 text-gray-600">
                            {{ $mensaje->mensaje }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endforeach

    <div id="messages"
        class="flex-1 p-3 overflow-y-auto scrollbar-thumb-blue scrollbar-thumb-rounded scrollbar-track-blue-lighter scrollbar-w-2 scrolling-touch">
        <div class="chat-message">
            <div class="flex items-end">
                <div class="flex flex-col space-y-2 text-xs max-w-xs mx-2 order-2 items-start">
                    <div><span class="px-4 py-2 rounded-lg inline-block rounded-bl-none bg-gray-300 text-gray-600">Can
                            be verified on any platform using docker</span></div>
                </div>
            </div>
        </div>
        <!-- more chat messages -->
    </div>
    <div class="chat-message">
        <div class="flex items-end justify-end">
           <div class="flex flex-col space-y-2 text-xs max-w-xs mx-2 order-1 items-end">
              <div><span class="px-4 py-2 rounded-lg inline-block rounded-br-none bg-blue-600 text-white ">yes, I have a mac. I never had issues with root permission as well, but this helped me to solve the problem</span></div>
           </div>
        </div>
     </div>

     <div class="border-t-2 border-gray-200 px-4 pt-4">
        <div class="relative flex">
            <input type="text" id="messageInput" placeholder="Write your message!"
                class="w-full focus:outline-none focus:placeholder-gray-400 text-gray-600 placeholder-gray-600 pl-12 bg-gray-200 rounded-md py-3">
            <button type="button" id="sendButton"
                class="inline-flex items-center justify-center rounded-lg px-4 py-3 transition duration-500 ease-in-out text-white bg-blue-500 hover:bg-blue-400 focus:outline-none">
                <span class="font-bold">Enviar</span>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                    class="h-6 w-6 ml-2 transform rotate-90">
                    <path
                        d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z">
                    </path>
                </svg>
            </button>
        </div>
    </div>
</div>

<style>
    .scrollbar-w-2::-webkit-scrollbar {
        width: 0.25rem;
        height: 0.25rem;
    }

    .scrollbar-track-blue-lighter::-webkit-scrollbar-track {
        --bg-opacity: 1;
        background-color: #f7fafc;
        background-color: rgba(247, 250, 252, var(--bg-opacity));
    }

    .scrollbar-thumb-blue::-webkit-scrollbar-thumb {
        --bg-opacity: 1;
        background-color: #edf2f7;
        background-color: rgba(237, 242, 247, var(--bg-opacity));
    }

    .scrollbar-thumb-rounded::-webkit-scrollbar-thumb {
        border-radius: 0.25rem;
    }
</style>

<script>
    const el = document.getElementById('messages');
    el.scrollTop = el.scrollHeight;

    // JavaScript for showing/hiding the menu
    const menuButton = document.getElementById('menuButton');
    const menuDropdown = document.getElementById('menuDropdown');

    menuButton.addEventListener('click', () => {
        if (menuDropdown.classList.contains('hidden')) {
            menuDropdown.classList.remove('hidden');
        } else {
            menuDropdown.classList.add('hidden');
        }
    });

    // Close the menu if you click outside of it
    document.addEventListener('click', (e) => {
        if (!menuDropdown.contains(e.target) && !menuButton.contains(e.target)) {
            menuDropdown.classList.add('hidden');
        }
    });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#sendButton').click(function() {
        var message = $('#messageInput').val();
        var receiverId = '{{ $opcional }}';  // Asume que tienes el ID del receptor en tu vista

        $.ajax({
            url: '{{ route("mensajes.enviar", $opcional) }}',  // Asegúrate de que la ruta esté correctamente definida
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                message: message
            },
            success: function(response) {
                if(response.success) {
                    $('#messageInput').val('');  // Limpia el campo de entrada
                } else {
                    alert('Error al enviar el mensaje');
                }
            },
            error: function(response) {
                alert('Error al enviar el mensaje');
            }
        });
    });
</script>