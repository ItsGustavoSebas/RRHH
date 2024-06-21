<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight ">
            {{ __('Comunicación RRHH') }}
        </h2>
    </x-slot>

    <form action="{{ route('comunicacion.guardar') }}" method="POST">
        @csrf
        <div class="max-w-2xl mx-auto mt-10 bg-white shadow-xl sm:rounded-lg p-6"> <!-- Contenedor centrado -->
            <div class="w-full max-w-md mx-auto p-5"> <!-- Ajuste del ancho -->
                <div class="text-center font-sans text-black font-bold text-3xl antialiased pb-10 mt-4">
                    COMENZAR CHAT
                </div>
    
                <div class="mb-5">
                    <div class="flex">
                        <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                            <i class="fa-solid fa-filter"></i>
                        </div>
                        <select name="receptor_id" id="receptor_id" class="w-full -ml-10 pl-10 pr-3 py-2 rounded-2xl border-2 border-gray-200 outline-none focus:border-indigo-500">
                            <option value="">Selecciona un usuario</option>
                            @foreach ($usuarios as $usuario)
                                <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('receptor_id')
                        <strong class="text-red-500">Debes seleccionar un usuario</strong>
                    @enderror
                </div>

                <div class="mb-5">
                    <label class="font-bold text-lg" for="mensaje">Mensaje</label>
                    <input id="mensaje" name="mensaje" type="text" class="px-3 py-2 w-full rounded-xl bg-blue-100" placeholder="Ingresa el mensaje" value="{{ old('mensaje') }}">
                    @error('mensaje')
                        <strong class="text-red-500">Debes ingresar el mensaje</strong>
                    @enderror
                </div>

                <div class="text-center">
                    <button type="submit" id="registrar" class="bg-blue-600 text-white font-bold px-6 py-3 rounded-lg">
                        <i class="fa-solid fa-floppy-disk"></i> GUARDAR
                    </button>
                </div>
            </div>
        </div>
    </form>
</x-app-layout>
