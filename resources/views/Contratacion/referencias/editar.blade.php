<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar referencia') }}
        </h2>
    </x-slot>

    <title>Editar referencia</title>

    <form action="{{ route('referencias.actualizar', $referencias->id) }}" method="POST">
        @csrf
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg m-5">

            <div class= "text-center font-sans text-black font-bold text-3xl antialiased  mt-10">
                Edite su referencia
            </div>

            <div class="grid lg:grid-cols-1 grid-cols-1 gap-4 p-5">
                <div class="col-span-1">
                    <label class="font-bold text-lg" for="nombre">Nombre de la persona</label>
                    <input id="nombre" name="nombre" type="text" class="px-3 py-2 w-full rounded-xl bg-blue-100" placeholder="Ingresa el nombre de la persona" value="{{ $referencias->nombre }}">
                    @error('nombre')
                        <strong class="text-red-500">Debes ingresar el nombre de la persona</strong>
                    @enderror
                </div>
                <br>
                            
                <div class="col-span-1">
                    <label class="font-bold text-lg" for="telefono">Telefono de la referencia</label>
                    <input id="telefono" name="telefono" type="text" class="px-3 py-2 w-full rounded-xl bg-blue-100" placeholder="Ingresa el telefono de la referencia" value="{{ $referencias->telefono }}">
                    @error('telefono')
                        <strong class="text-red-500">Debes ingresar el telofono referencia</strong>
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