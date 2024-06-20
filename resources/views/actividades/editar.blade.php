<!-- resources/views/actividades/editar.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Actividad') }}
        </h2>
    </x-slot>

    <title>Editar Actividad</title>

    @can('Editar Actividades')
        <form action="{{ route('actividades.actualizar', $actividad->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg m-5">
                <div class="text-center font-sans text-black font-bold text-3xl antialiased mt-10">
                    Editar Actividad
                </div>
                <div class="grid lg:grid-cols-1 grid-cols-1 gap-4 p-5">
                    <div class="col-span-1">
                        <label class="font-bold text-lg" for="nombre">Nombre de la Actividad</label>
                        <input id="nombre" name="nombre" type="text" class="px-3 py-2 w-full rounded-xl bg-blue-100" placeholder="Ingresa el nombre de la actividad" value="{{ $actividad->nombre }}" required>
                        @error('nombre')
                            <strong class="text-red-500">Debes ingresar el nombre de la actividad</strong>
                        @enderror
                    </div>
                    <div class="col-span-1">
                        <label class="font-bold text-lg" for="descripcion">Descripción</label>
                        <textarea id="descripcion" name="descripcion" class="px-3 py-2 w-full rounded-xl bg-blue-100" placeholder="Ingresa la descripción de la actividad" required>{{ $actividad->descripcion }}</textarea>
                        @error('descripcion')
                            <strong class="text-red-500">Debes ingresar una descripción</strong>
                        @enderror
                    </div>
                    <div class="col-span-1">
                        <label class="font-bold text-lg" for="fecha_inicio">Fecha de Inicio</label>
                        <input id="fecha_inicio" name="fecha_inicio" type="date" class="px-3 py-2 w-full rounded-xl bg-blue-100" placeholder="Ingresa la fecha de inicio de la actividad" value="{{ \Carbon\Carbon::parse($actividad->fecha_inicio)->format('Y-m-d') }}" required>
                        @error('fecha_inicio')
                            <strong class="text-red-500">Debes ingresar la fecha de inicio</strong>
                        @enderror
                    </div>
                    <div class="col-span-1">
                        <label class="font-bold text-lg" for="hora_inicio">Hora de Inicio</label>
                        <input id="hora_inicio" name="hora_inicio" type="time" class="px-3 py-2 w-full rounded-xl bg-blue-100" placeholder="Ingresa la hora de inicio de la actividad" value="{{ \Carbon\Carbon::parse($actividad->hora_inicio)->format('H:i') }}" required>
                        @error('hora_inicio')
                            <strong class="text-red-500">Debes ingresar la hora de inicio</strong>
                        @enderror
                    </div>
                    <div class="col-span-1">
                        <label class="font-bold text-lg" for="fecha_fin">Fecha de Fin</label>
                        <input id="fecha_fin" name="fecha_fin" type="date" class="px-3 py-2 w-full rounded-xl bg-blue-100" placeholder="Ingresa la fecha de fin de la actividad" value="{{ \Carbon\Carbon::parse($actividad->fecha_fin)->format('Y-m-d') }}" required>
                        @error('fecha_fin')
                            <strong class="text-red-500">Debes ingresar la fecha de fin</strong>
                        @enderror
                    </div>
                    <div class="col-span-1">
                        <label class="font-bold text-lg" for="hora_fin">Hora de Fin</label>
                        <input id="hora_fin" name="hora_fin" type="time" class="px-3 py-2 w-full rounded-xl bg-blue-100" placeholder="Ingresa la hora de fin de la actividad" value="{{ \Carbon\Carbon::parse($actividad->hora_fin)->format('H:i') }}" required>
                        @error('hora_fin')
                            <strong class="text-red-500">Debes ingresar la hora de fin</strong>
                        @enderror
                    </div>
                    <div class="col-span-1 p-5 text-center">
                        <button type="submit" id="guardar" class="bg-blue-600 text-white font-bold px-6 py-3 rounded-lg">
                            <i class="fa-solid fa-floppy-disk"> GUARDAR</i>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    @endcan
</x-app-layout>
