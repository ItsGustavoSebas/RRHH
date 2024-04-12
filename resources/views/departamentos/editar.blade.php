<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Departamento') }}
        </h2>
    </x-slot>

    <title>Editar_Departamento</title>

    <form action="{{ route('departamentos.actualizar', $departamentos->id) }}" method="POST">
        @csrf
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg m-5">
            <div class="grid lg:grid-cols-3 grid-cols-1 gap-4 p-5">
                <div class="col-span-1">
                    <label class="font-bold text-lg" for=""> Nombre</label>
                    <input id="nombre" name = "nombre" type="text" class="px3 py2 w-full rounded-xl bg-blue-100" value="{{ $departamentos->nombre }}">
                    @error('nombre')
                        <strong class = "text-red-500">Debes ingresar tu nombre</strong>
                    @enderror
                </div>
                
                <div class = "p-5">
                    <button type ="submit" class="bg-blue-600 text-white fond-bold px-5 py-3 rounded-lg">
                        <i class= "fa-solid fa-floppy-disk">Guardar</i>
                    </button>
                </div>

            </div>

        </div>
    </form>

</x-app-layout>
