<x-app-layout>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- Scripts -->
        <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.4.2/zxcvbn.js"></script>

        <style>
            @import url('https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.min.css');
        </style>
        <title>Editar Horario</title>
    </head>
    <form action="{{ route('horarios.actualizar', $horarios->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="bg-gradient-to-r from-indigo-700 to-indigo-950 p-8">
            <!-- Cuadro exterior con fondo azul marino y relleno de 8 unidades -->
            <div class="bg-gray-100 p-4 overflow-hidden shadow-xl sm:rounded-lg m-5 ">
                <div class= "text-center font-sans text-black font-bold text-3xl antialiased pb-10 mt-10">
                    EDITAR HORARIO
                </div>
                <div class="flex flex-wrap -mx-3">
                    <div class="w-full md:w-1/3 px-3 mb-5">
                        <label class="font-bold text-lg" for="HoraInicio">Hora de Inicio</label>
                        <div class="flex">
                            <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                                <i class="fa-solid fa-clock"></i>
                            </div>
                            <input id="HoraInicio" type="time" name="HoraInicio"
                                class="w-full -ml-10 pl-10 pr-3 py-2 rounded-2xl border-2 border-gray-200 outline-none focus:border-indigo-500"
                                placeholder="Ejemplo 07:00" value="{{ old('HoraInicio', $horarios->HoraInicio) }}">
                        </div>
                        @error('HoraInicio')
                            <strong class="text-red-500">Debes ingresar la Hora de Inicio</strong>
                        @enderror
                    </div>
                    <div class="w-full md:w-1/3 px-3 mb-5">
                        <label class="font-bold text-lg" for="HoraFin">Hora de Finalización</label>
                        <div class="flex">
                            <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                                <i class="fa-solid fa-clock"></i>
                            </div>
                            <input id="HoraFin" type="time" name="HoraFin"
                                class="w-full -ml-10 pl-10 pr-3 py-2 rounded-2xl border-2 border-gray-200 outline-none focus:border-indigo-500"
                                placeholder="Ejemplo 07:00" value="{{ old('HoraFin', $horarios->HoraFin) }}">
                        </div>
                        @error('HoraFin')
                            <strong class="text-red-500">Debes ingresar la Hora de Finalización</strong>
                        @enderror
                    </div>
                    <div class="w-full md:w-1/3 px-3 mb-5">
                        <label class="font-bold text-lg" for="HoraLimite">Hora de Atraso</label>
                        <div class="flex">
                            <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                                <i class="fa-solid fa-clock"></i>
                            </div>
                            <input id="HoraLimite" type="time" name="HoraLimite"
                                class="w-full -ml-10 pl-10 pr-3 py-2 rounded-2xl border-2 border-gray-200 outline-none focus:border-indigo-500"
                                placeholder="Ejemplo 07:00" value="{{ old('HoraLimite', $horarios->HoraLimite) }}">
                        </div>
                    </div>
                </div>
                
                @can('Actualizar Horarios')
                    <div class="flex -mx-3 pt-9">
                        <div class="w-full px-3 mb-5">
                            <button type ="submit" id="guardar"
                                class="block w-full max-w-xs mx-auto bg-indigo-500 hover:bg-indigo-700 focus:bg-indigo-700 text-white rounded-lg px-3 py-3 font-semibold">Guardar
                            </button>
                        </div>
                    </div>
                @endcan
            </div>
        </div>
        </div>
    </form>
</x-app-layout>
