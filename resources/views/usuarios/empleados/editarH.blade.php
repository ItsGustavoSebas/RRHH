
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
        <title>Asignar Horarios</title>
    </head>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('empleados.guardarHorario', $empleados->usuario->id) }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <div class= "text-center font-sans text-black font-bold text-3xl antialiased pb-10 mt-10">
                                EDITAR HORARIOS
                            </div>
                            <label for="diasTrabajo" class="block text-gray-700 text-sm font-bold mb-2">Días de
                                Trabajo:</label>
                            @foreach ($diasTrabajo as $dia)
                            @php
                                $horarios_empleado = $empleados->horario_empleado;
                                $asignado = 0;
                                foreach ($horarios_empleado as $horario_empleado){
                                    if($horario_empleado->dia_horario_empleado->DiaTrabajo->id == $dia->id){
                                        $asignado = $horario_empleado->dia_horario_empleado->HorarioEmpleado->Horario->id;
                                    }
                                }
                            @endphp
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2">
                                        {{ $dia->Nombre }}
                                    </label>
                                    <select name="horario[{{ $dia->id }}]"
                                        class="w-full bg-gray-100 border border-gray-300 p-2 rounded">
                                        <option value="">Seleccionar Horario</option>
                                        @foreach ($horarios as $horario)
                                            <option value="{{ $horario->id }}" @if ($asignado == $horario->id) selected @endif>{{ $horario->HoraInicio }} -
                                                {{ $horario->HoraFin }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endforeach
                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Guardar Horarios
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
