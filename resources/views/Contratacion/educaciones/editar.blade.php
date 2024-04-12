<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar educación') }}
        </h2>
    </x-slot>

    <title>Editar educación</title>

    <form action="{{ route('educaciones.actualizar', $educaciones->id) }}" method="POST">
        @csrf
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg m-5">

            <div class= "text-center font-sans text-black font-bold text-3xl antialiased  mt-10">
                Edite su educación
            </div>

            <div class="grid lg:grid-cols-1 grid-cols-1 gap-4 p-5">
                <div class="col-span-1">
                    <label class="font-bold text-lg" for="nombre_colegio">Nombre del colegio/instituto/universidad</label>
                    <input id="nombre_colegio" name="nombre_colegio" type="text" class="px-3 py-2 w-full rounded-xl bg-blue-100" placeholder="Ingresa el nombre" value="{{ $educaciones->nombre_colegio }}">
                    @error('nombre_colegio')
                        <strong class="text-red-500">Debes ingresar el nombre</strong>
                    @enderror
                </div>
                <br>
                            
                <div class="col-span-1">
                    <label class="font-bold text-lg" for="grado_diploma">Grado del diploma</label>
                    <input id="grado_diploma" name="grado_diploma" type="text" class="px-3 py-2 w-full rounded-xl bg-blue-100" placeholder="Ingresa el grado del diploma" value="{{ $educaciones->grado_diploma }}">
                    @error('grado_diploma')
                        <strong class="text-red-500">Debes ingresar el grado del diploma</strong>
                    @enderror
                </div>
                            
                <br>

                <div class="col-span-1">
                    <label class="font-bold text-lg" for="campo_de_estudio">Campo de estudio</label>
                    <input id="campo_de_estudio" name="campo_de_estudio" type="text" class="px-3 py-2 w-full rounded-xl bg-blue-100" placeholder="Ingresa el campo de estudio" value="{{ $educaciones->campo_de_estudio }}">
                    @error('campo_de_estudio')
                        <strong class="text-red-500">Debes ingresar el campo de estudio</strong>
                    @enderror
                </div>
                            
                <br>

                <div class="col-span-1">
                    <label class="font-bold text-lg" for="fecha_de_finalizacion">Fecha de finalización</label>
                    <input id="fecha_de_finalizacion" name="fecha_de_finalizacion" type="date" class="px-3 py-2 w-full rounded-xl bg-blue-100" placeholder="Ingresa la fecha de finalización" value="{{ $educaciones->fecha_de_finalizacion }}">
                    @error('fecha_de_finalizacion')
                        <strong class="text-red-500">Debes ingresar la fecha de finalización</strong>
                    @enderror
                </div>

                <br>

                            
                <div class="col-span-1">
                    <label class="font-bold text-lg" for="notas_adicionales">Notas adicionales</label>
                    <input id="notas_adicionales" name="notas_adicionales" type="text" class="px-3 py-2 w-full rounded-xl bg-blue-100" placeholder="Ingrese notas adicionales" value="{{ $educaciones->notas_adicionales }}">
                </div>

                <br>
                            
                <div class="p-5 text-center">
                    <button type="submit" id="registrar" class="bg-blue-600 text-white font-bold px-6 py-3 rounded-lg">
                        <i class="fa-solid fa-floppy-disk">GUARDAR</i>
                    </button>
                </div>
            </div>
            

        </div>
    </form>


</x-app-layout>