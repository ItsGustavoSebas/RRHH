<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Entrevista') }}
        </h2>
    </x-slot>

    <title>Editar Entrevista</title>

    <form action="{{ route('entrevistas.actualizar', $entrevistas->id) }}" method="POST">
        @csrf
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg m-5">

            <div class= "text-center font-sans text-black font-bold text-3xl antialiased  mt-10">
                Edite la entrevista
            </div>

            <div class="grid lg:grid-cols-1 grid-cols-1 gap-4 p-5">


                <div class="col-span-1">
                    <label class="font-bold text-lg" for="fecha_inicio">Fecha de inicio de la entrevista</label>
                    <input id="fecha_inicio" name="fecha_inicio" type="date" class="px-3 py-2 w-full rounded-xl bg-blue-100" placeholder="Ingresa la fecha de inicio de la entrevista" value="{{ $entrevistas->fecha_inicio }}">
                    @error('fecha_inicio')
                        <strong class="text-red-500">Debes ingresar la fecha de inicio</strong>
                    @enderror
                </div>

                                            
                <div class="col-span-1">
                    <label class="font-bold text-lg" for="hora">Hora de la entrevista</label>
                    <input id="hora" name="hora" type="text" class="px-3 py-2 w-full rounded-xl bg-blue-100" placeholder="Ingrese la hora de entrevista" value="{{ $entrevistas->hora }}">
                </div>

   

                <div class="col-span-1">
                    <label class="font-bold text-lg" for="fecha_inicio">Fecha de finalización</label>
                    <input id="fecha_fin" name="fecha_fin" type="date" class="px-3 py-2 w-full rounded-xl bg-blue-100" placeholder="Ingresa la fecha de finalización de la entrevista" value="{{ $entrevistas->fecha_fin }}">
                    @error('fecha_fin')
                        <strong class="text-red-500">Debes ingresar la fecha de finalización</strong>
                    @enderror
                </div>

                            
                <div class="col-span-1">
                    <label class="font-bold text-lg" for="detalles">Detalles de la entrevista</label>
                    <input id="detalles" name="detalles" type="text" class="px-3 py-2 w-full rounded-xl bg-blue-100" placeholder="Ingrese notas adicionales" value="{{ $entrevistas->detalles }}">
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