<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar reconocimiento') }}
        </h2>
    </x-slot>

    <title>Editar reconocimiento</title>

    <form action="{{ route('educaciones.actualizar', $educaciones->id) }}" method="POST">
        @csrf
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg m-5">

            <div class= "text-center font-sans text-black font-bold text-3xl antialiased  mt-10">
                Edite su reconocimiento
            </div>

            <div class="grid lg:grid-cols-1 grid-cols-1 gap-4 p-5">
                <div class="col-span-1">
                    <label class="font-bold text-lg" for="nombre">Nombre del reconocimiento</label>
                    <input id="nombre" name="nombre" type="text" class="px-3 py-2 w-full rounded-xl bg-blue-100" placeholder="Ingresa el nombre" value="{{ $educaciones->nombre }}">
                    @error('nombre')
                        <strong class="text-red-500">Debes ingresar el nombre del reconocimiento</strong>
                    @enderror
                </div>
                <br>
                            
                <div class="col-span-1">
                    <label class="font-bold text-lg" for="descripcion">Descripción del reconocimiento</label>
                    <input id="descripcion" name="descripcion" type="text" class="px-3 py-2 w-full rounded-xl bg-blue-100" placeholder="Ingresa la descripción del reconocimiento" value="{{ $educaciones->descripcion }}">
                    @error('descripcion')
                        <strong class="text-red-500">Debes ingresar la descripción del reconocimiento</strong>
                    @enderror
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