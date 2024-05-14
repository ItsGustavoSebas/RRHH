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
        <title>Editar Horarios</title>
    </head>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('empleados.guardarHorario', $empleados->usuario->id) }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <div class="text-center font-sans text-black font-bold text-3xl antialiased pb-10 mt-10">
                                EDITAR HORARIOS
                            </div>

                            <label for="diasTrabajo" class="block text-gray-700 text-sm font-bold mb-2">Días de
                                Trabajo:</label>
                            @foreach ($diasTrabajo as $diaTrabajo)
                                <div>
                                    <label
                                        class="block font-medium text-sm text-gray-700">{{ $diaTrabajo->Nombre }}</label>
                                    <select name="horario[{{ ($diaTrabajo->id)}}]"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        <option value="">Seleccione un horario</option>
                                        @foreach ($horarios as $horario)
                                            <option value="{{ ($horario->id)}}"
                                                {{ isset($horariosAsignados[($diaTrabajo->id)-1]) && $horariosAsignados[($diaTrabajo->id)-1]['id'] == $horario->id ? 'selected' : '' }}>
                                                {{ $horario->HoraInicio }} - {{ $horario->HoraFin }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-4">
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring focus:ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Guardar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
