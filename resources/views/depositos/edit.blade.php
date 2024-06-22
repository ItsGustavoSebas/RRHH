<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Depósito') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <form action="{{ route('depositos.update', $deposito->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="p-6">
                        <div>
                            <label for="empleado_id" class="block text-sm font-medium text-gray-700">Empleado</label>
                            <select name="empleado_id" id="empleado_id" class="form-select mt-1 block w-full">
                                <option value="">Seleccione un empleado</option>
                                @foreach ($empleados as $empleado)
                                    <option value="{{ $empleado->ID_Usuario }}" {{ $deposito->empleado_id == $empleado->ID_Usuario ? 'selected' : '' }}>{{ $empleado->usuario->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-4">
                            <label for="fecha" class="block text-sm font-medium text-gray-700">Fecha</label>
                            <input type="date" name="fecha" id="fecha" value="{{ $deposito->fecha }}" class="form-input mt-1 block w-full">
                        </div>
                        <div class="mt-4">
                            <label for="monto" class="block text-sm font-medium text-gray-700">Monto</label>
                            <input type="number" name="monto" id="monto" value="{{ $deposito->monto }}" class="form-input mt-1 block w-full">
                        </div>
                        <div class="mt-4">
                            <label for="depositado" class="block text-sm font-medium text-gray-700">Depositado</label>
                            <select name="depositado" id="depositado" class="form-select mt-1 block w-full">
                                <option value="0" {{ !$deposito->depositado ? 'selected' : '' }}>No</option>
                                <option value="1" {{ $deposito->depositado ? 'selected' : '' }}>Sí</option>
                            </select>
                        </div>
                        <div class="mt-6">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
