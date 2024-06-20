<x-app-layout>




    @foreach ($mensajes as $mensaje)
    @endforeach


    <div class="flex-1 p-2 sm:p-4 justify-between flex flex-col h-screen bg-white">
        <div class="flex sm:items-center justify-between py-3 border-b-2 border-gray-200">
            <div class="relative flex items-center space-x-4">
                <div class="relative">
                    <span class="absolute text-green-500 right-0 bottom-0">
                        <svg width="20" height="20">
                            <circle cx="8" cy="8" r="8" fill="currentColor"></circle>
                        </svg>
                    </span>




                    @if ($mensaje->receptor_id === Auth::id())

                        @if ($mensaje->emisor->Empleado)
                            <img id="imagen" src="{{ asset($mensaje->emisor->empleado->ruta_imagen_e) }}"
                                class="w-16 h-16 object-cover rounded-full" alt=""
                                class="w-10 sm:w-16 h-10 sm:h-16 rounded-full"> {{-- style="width:100px; height:100px;"  --}}
                        @else
                            <img id="imagen" src="{{ asset($mensaje->emisor->postulante->ruta_imagen_e) }}"
                                class="w-16 h-16 object-cover rounded-full" alt=""
                                class="w-10 sm:w-16 h-10 sm:h-16 rounded-full"> {{-- style="width:100px; height:100px;"  --}}
                        @endif
                    @else
                        @if ($mensaje->receptor->Empleado)
                            <img id="imagen" src="{{ asset($mensaje->receptor->empleado->ruta_imagen_e) }}"
                                class="w-16 h-16 object-cover rounded-full" alt=""
                                class="w-10 sm:w-16 h-10 sm:h-16 rounded-full"> {{-- style="width:100px; height:100px;"  --}}
                        @else
                            <img id="imagen" src="{{ asset($mensaje->receptor->postulante->ruta_imagen_e) }}"
                                class="w-16 h-16 object-cover rounded-full" alt=""
                                class="w-10 sm:w-16 h-10 sm:h-16 rounded-full"> {{-- style="width:100px; height:100px;"  --}}
                        @endif

                    @endif
                </div>
                <div class="flex flex-col leading-tight">



                    @if ($mensaje->receptor_id === Auth::id())
                        @if ($mensaje->emisor->Empleado)
                            <div class="text-2xl mt-1 flex items-center">

                                <span class="text-gray-700 mr-3">{{ $mensaje->emisor->name }}</span>
                            </div>
                            <span class="text-lg text-gray-600">{{ $mensaje->emisor->empleado->cargo->nombre }}</span>
                        @else
                            <div class="text-2xl mt-1 flex items-center">

                                <span class="text-gray-700 mr-3">{{ $mensaje->emisor->name }}</span>
                            </div>
                            <span
                                class="text-lg text-gray-600">{{ $mensaje->emisor->postulante->puesto_disponible->nombre }}</span>
                        @endif
                    @else
                        @if ($mensaje->receptor->Empleado)
                            <div class="text-2xl mt-1 flex items-center">

                                <span class="text-gray-700 mr-3">{{ $mensaje->receptor->name }}</span>
                            </div>
                            <span
                                class="text-lg text-gray-600">{{ $mensaje->receptor->empleado->cargo->nombre }}</span>
                        @else
                            <div class="text-2xl mt-1 flex items-center">

                                <span class="text-gray-700 mr-3">{{ $mensaje->receptor->name }}</span>
                            </div>
                            <span
                                class="text-lg text-gray-600">{{ $mensaje->receptor->postulante->puesto_disponible->nombre?? "Sin postulación" }}</span>
                        @endif
                    @endif



                </div>
            </div>

        </div>
        <div id="messages"
            class="flex flex-col space-y-4 p-3 overflow-y-auto scrollbar-thumb-blue scrollbar-thumb-rounded scrollbar-track-blue-lighter scrollbar-w-2 scrolling-touch">


            @foreach ($mensajes as $mensaje)
                @if ($mensaje->receptor_id === Auth::id())
                    <div class="chat-message">
                        <div class="flex items-end">
                            <div class="flex space-x-2 text-xs max-w-xs mx-2 order-2 items-center">
                                @if ($mensaje->emisor->Empleado)
                                    <img id="imagen" src="{{ asset($mensaje->emisor->empleado->ruta_imagen_e) }}"
                                        class="w-10 h-10 object-cover rounded-full" alt=""
                                        class="w-10 sm:w-16 h-10 sm:h-16 rounded-full"> {{-- style="width:100px; height:100px;"  --}}
                                @else
                                    <img id="imagen" src="{{ asset($mensaje->emisor->postulante->ruta_imagen_e) }}"
                                        class="w-10 h-10 object-cover rounded-full" alt=""
                                        class="w-10 sm:w-16 h-10 sm:h-16 rounded-full"> {{-- style="width:100px; height:100px;"  --}}
                                @endif
                                <div><span
                                        class="px-4 py-2 rounded-lg inline-block rounded-bl-none bg-gray-300 text-gray-600">{{ $mensaje->mensaje }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="chat-message">
                        <div class="flex items-end justify-end">
                            <div class="flex space-x-2 text-xs max-w-xs mx-2 order-1 items-center justify-end">
                                <div><span
                                        class="px-4 py-2 rounded-lg inline-block rounded-br-none bg-blue-600 text-white">{{ $mensaje->mensaje }}</span>
                                </div>
                                @if ($mensaje->emisor->Empleado)
                                    <img id="imagen" src="{{ asset($mensaje->emisor->empleado->ruta_imagen_e) }}"
                                        class="w-10 h-10 object-cover rounded-full" alt=""
                                        class="w-10 sm:w-16 h-10 sm:h-16 rounded-full"> {{-- style="width:100px; height:100px;"  --}}
                                @else
                                    <img id="imagen" src="{{ asset($mensaje->emisor->postulante->ruta_imagen_e) }}"
                                        class="w-10 h-10 object-cover rounded-full" alt=""
                                        class="w-10 sm:w-16 h-10 sm:h-16 rounded-full"> {{-- style="width:100px; height:100px;"  --}}
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach






        </div>


        <form action="{{ route('comunicacion.guardarCHAT') }}" method="POST" class="">
            @csrf
            <div class="border-t-2 border-gray-200 px-4 pt-4 mb-2 sm:mb-0">
                <div class="relative flex">
                    <span class="absolute inset-y-0 flex items-center">
                        <button type="button"
                            class="inline-flex items-center justify-center rounded-full h-12 w-12 transition duration-500 ease-in-out text-gray-500 hover:bg-gray-300 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" class="h-6 w-6 text-gray-600">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z">
                                </path>
                            </svg>
                        </button>
                    </span>
                    <input type="hidden" name="receptor_id"
                        value="{{ $mensaje->receptor_id === Auth::id() ? $mensaje->emisor_id : $mensaje->receptor_id }}">
                    <input id="mensaje" name="mensaje" type="text" placeholder="Escribe tu mensaje!"
                        class="w-full focus:outline-none focus:placeholder-gray-400 text-gray-600 placeholder-gray-600 pl-12 bg-gray-200 rounded-md py-3">
                    <div class="absolute right-0 items-center inset-y-0 hidden sm:flex">


                        <button type="submit" id="registrar"
                            class="inline-flex items-center justify-center rounded-lg px-4 py-3 transition duration-500 ease-in-out text-white bg-blue-500 hover:bg-blue-400 focus:outline-none">
                            <span class="font-bold">Send</span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                class="h-6 w-6 ml-2 transform rotate-90">
                                <path
                                    d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z">
                                </path>
                            </svg>
                        </button>
                    </div>
                    @error('mensaje')
                        <strong class="text-red-500">Debes ingresar el mensaje</strong>
                    @enderror
                </div>
            </div>
        </form>
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
        const el = document.getElementById('messages')
        el.scrollTop = el.scrollHeight
    </script>

</x-app-layout>
