<!-- resources/views/actividades/crear.blade.php -->
<x-app-layout>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Crear Actividad</title>
        <!-- Scripts -->
        <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
    </head>
    @can('Crear Actividades')
        <form action="{{ route('actividades.guardar') }}" method="POST">
            @csrf
            <div class="bg-gradient-to-r from-indigo-700 to-indigo-950 p-8">
                <div class="bg-gray-100 p-4 overflow-hidden shadow-xl sm:rounded-lg m-5">
                    <div class="text-center font-sans text-black font-bold text-3xl antialiased pb-10 mt-10">
                        REGISTRAR ACTIVIDAD
                    </div>
                    <div>
                        <label class="font-bold text-lg" for="nombre">Nombre de la Actividad</label>
                        <div class="flex -mx-3">
                            <div class="w-full px-3 mb-5">
                                <div class="flex">
                                    <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                                        <i class="fa-solid fa-tag"></i>
                                    </div>
                                    <input id="nombre" type="text" name="nombre" class="w-full -ml-10 pl-10 pr-3 py-2 rounded-2xl border-2 border-gray-200 outline-none focus:border-indigo-500" placeholder="Ingresar el nombre de la actividad" value="{{ old('nombre') }}" required>
                                    @error('nombre')
                                        <strong class="text-red-500">Debes ingresar el nombre de la actividad</strong>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label class="font-bold text-lg" for="descripcion">Descripción</label>
                        <div class="flex -mx-3">
                            <div class="w-full px-3 mb-5">
                                <div class="flex">
                                    <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                                        <i class="fa-regular fa-file"></i>
                                    </div>
                                    <textarea id="descripcion" name="descripcion" class="w-full -ml-10 pl-10 pr-3 py-2 rounded-2xl border-2 border-gray-200 outline-none focus:border-indigo-500" placeholder="Ingresar la descripción de la actividad">{{ old('descripcion') }}</textarea>
                                    @error('descripcion')
                                        <strong class="text-red-500">Debes ingresar una descripción</strong>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label class="font-bold text-lg" for="fecha_inicio">Fecha de Inicio</label>
                        <div class="flex -mx-3">
                            <div class="w-full px-3 mb-5">
                                <div class="flex">
                                    <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                                        <i class="fa-solid fa-calendar-alt"></i>
                                    </div>
                                    <input id="fecha_inicio" type="date" name="fecha_inicio" class="w-full -ml-10 pl-10 pr-3 py-2 rounded-2xl border-2 border-gray-200 outline-none focus:border-indigo-500" value="{{ old('fecha_inicio') }}" required>
                                    @error('fecha_inicio')
                                        <strong class="text-red-500">Debes ingresar la fecha de inicio</strong>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label class="font-bold text-lg" for="hora_inicio">Hora de Inicio</label>
                        <div class="flex -mx-3">
                            <div class="w-full px-3 mb-5">
                                <div class="flex">
                                    <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                                        <i class="fa-solid fa-clock"></i>
                                    </div>
                                    <input id="hora_inicio" type="time" name="hora_inicio" class="w-full -ml-10 pl-10 pr-3 py-2 rounded-2xl border-2 border-gray-200 outline-none focus:border-indigo-500" value="{{ old('hora_inicio') }}" required>
                                    @error('hora_inicio')
                                        <strong class="text-red-500">Debes ingresar la hora de inicio</strong>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label class="font-bold text-lg" for="fecha_fin">Fecha de Fin</label>
                        <div class="flex -mx-3">
                            <div class="w-full px-3 mb-5">
                                <div class="flex">
                                    <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                                        <i class="fa-solid fa-calendar-alt"></i>
                                    </div>
                                    <input id="fecha_fin" type="date" name="fecha_fin" class="w-full -ml-10 pl-10 pr-3 py-2 rounded-2xl border-2 border-gray-200 outline-none focus:border-indigo-500" value="{{ old('fecha_fin') }}" required>
                                    @error('fecha_fin')
                                        <strong class="text-red-500">Debes ingresar la fecha de fin</strong>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label class="font-bold text-lg" for="hora_fin">Hora de Fin</label>
                        <div class="flex -mx-3">
                            <div class="w-full px-3 mb-5">
                                <div class="flex">
                                    <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                                        <i class="fa-solid fa-clock"></i>
                                    </div>
                                    <input id="hora_fin" type="time" name="hora_fin" class="w-full -ml-10 pl-10 pr-3 py-2 rounded-2xl border-2 border-gray-200 outline-none focus:border-indigo-500" value="{{ old('hora_fin') }}" required>
                                    @error('hora_fin')
                                        <strong class="text-red-500">Debes ingresar la hora de fin</strong>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex -mx-3 pt-9">
                        <div class="w-full px-3 mb-5">
                            <button type="submit" id="guardar" class="block w-full max-w-xs mx-auto bg-indigo-500 hover:bg-indigo-700 focus:bg-indigo-700 text-white rounded-lg px-3 py-3 font-semibold">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    @endcan
</x-app-layout>
