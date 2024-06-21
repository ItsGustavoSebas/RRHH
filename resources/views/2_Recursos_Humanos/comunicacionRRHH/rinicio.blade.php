<x-app-layout>
    <x-slot name="header">
        <div class = "flex flex-wrap justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Lista de chats') }}
            </h2>

            <a class = "px-3 py-2 bg-indigo-600 font-bold text-white rounded-lg"
                href="{{ route('comunicacion.crear') }}">Comenzar chat con...</a>

        </div>
    </x-slot>

    <title>CHATS</title>

    <table class="min-w-full border-collapse block md:table">

        <div class="flex justify-center flex-wrap">
            @foreach ($mensajes as $mensaje)
                <div class="flex-shrink-0 m-6 relative overflow-hidden bg-orange-500 rounded-lg max-w-xs shadow-lg">
                    <svg class="absolute bottom-0 left-0 mb-8" viewBox="0 0 375 283" fill="none"
                        style="transform: scale(1.5); opacity: 0.1;">
                        <rect x="159.52" y="175" width="152" height="152" rx="8"
                            transform="rotate(-45 159.52 175)" fill="white" />
                        <rect y="107.48" width="152" height="152" rx="8" transform="rotate(-45 0 107.48)"
                            fill="white" />
                    </svg>
                    <div class="relative pt-10 px-10 flex items-center justify-center">
                        <div class="block absolute w-48 h-48 bottom-0 left-0 -mb-24 ml-3"
                            style="background: radial-gradient(black, transparent 60%); transform: rotate3d(0, 0, 1, 20deg) scale3d(1, 0.6, 1); opacity: 0.2;">
                        </div>



                        @if ($mensaje->receptor_id === Auth::id())
                            @if ($mensaje->emisor->Empleado)
                                <img id="imagen" src="{{ asset($mensaje->emisor->empleado->ruta_imagen_e) }}"
                                    class="relative w-40 h-40 object-cover" alt="">
                            @else
                                <img id="imagen" src="{{ asset($mensaje->emisor->postulante->ruta_imagen_e) }}"
                                    class="relative w-40 h-40 object-cover" alt="">
                            @endif
                        @else
                            @if ($mensaje->receptor->Empleado)
                                <img id="imagen" src="{{ asset($mensaje->receptor->empleado->ruta_imagen_e) }}"
                                    class="relative w-40 h-40 object-cover" alt="">
                            @else
                                <img id="imagen" src="{{ asset($mensaje->receptor->postulante->ruta_imagen_e) }}"
                                    class="relative w-40 h-40 object-cover" alt="">
                            @endif
                        @endif


                    </div>


                    <div class="relative text-white px-6 pb-6 mt-6">
                        <span class="block opacity-75 -mb-1">Chat con</span>
                        <div class="flex justify-between">
                            @if ($mensaje->receptor_id === Auth::id())
                                <span class="block font-semibold text-xl">{{ $mensaje->emisor->name }}</span>
                                <a href="{{ route('comunicacion.mostrar', $mensaje->emisor->id) }}"
                                    class="block bg-white rounded-full text-orange-500 text-xs font-bold px-3 py-2 leading-none flex items-center">Abrir</a>
                            @else
                                <span class="block font-semibold text-xl">{{ $mensaje->receptor->name }}</span>
                                <a href="{{ route('comunicacion.mostrar', $mensaje->receptor->id) }}"
                                    class="block bg-white rounded-full text-orange-500 text-xs font-bold px-3 py-2 leading-none flex items-center">Abrir</a>
                            @endif

                        </div>
                    </div>

                </div>
            @endforeach
        </div>

    </table>

</x-app-layout>
