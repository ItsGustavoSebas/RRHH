<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Departamento') }}
        </h2>
    </x-slot>

    <title>Crear_Departamento</title>

    <form action="{{ route('comunicacion.guardar') }}" method="POST">
        @csrf
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg m-5">
            <div class="grid lg:grid-cols-3 grid-cols-1 gap-4 p-5">

                <div class="w-full px-3 mb-5">
                    <div class="flex">
                        <div
                            class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                            <i class="fa-solid fa-filter"></i>
                        </div>
                        <select name="receptor_id" id="receptor_id"
                            class="w-full -ml-10 pl-10 pr-3 py-2 rounded-2xl border-2 border-gray-200 outline-none focus:border-indigo-500">
                            <option value="">Selecciona un usuario</option>
                            @foreach ($usuarios as $usuario)
                                <option value="{{ $usuario->id }}">{{ $usuario->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('receptor_id')
                        <strong class = "text-red-500">Debes seleccionar un usuario</strong>
                    @enderror
                </div>



                <div class="col-span-1">
                    <label class="font-bold text-lg" for=""> Mensaje</label>
                    <input id="mensaje" name = "mensaje" type="text" class="px3 py2 w-full rounded-x1 bg-blue-100" 
                    placeholder="Ingresa el mensaje" value="{{ old('mensaje') }}">
                    @error('mensaje')
                        <strong class = "text-red-500">Debes ingresar el mensaje</strong>
                    @enderror
                </div>


                <div class = "p-5">
                    <button type ="submit" id="registrar" class="bg-blue-600 text-white fond-bold px-6 py-3 rounded-lg">
                        <i class= "fa-solid fa-floppy-disk">GUARDAR</i>
                    </button>
                </div>

            </div>



        </div>
    </form>

</x-app-layout>