<!-- resources/views/depositos/show.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalles del Depósito') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <div class="mb-4">
                        <h3 class="text-lg font-medium text-gray-900">Información del Depósito</h3>
                        <p class="mt-1 text-sm text-gray-600">Detalles del depósito seleccionado.</p>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Empleado</label>
                        <div class="mt-1 text-sm text-gray-900">{{ $deposito->empleado->usuario->name }}</div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Fecha</label>
                        <div class="mt-1 text-sm text-gray-900">{{ $deposito->fecha }}</div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Monto</label>
                        <div class="mt-1 text-sm text-gray-900">{{ $deposito->monto }}</div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Estado</label>
                        <div class="mt-1 text-sm text-gray-900">{{ $deposito->depositado ? 'Realizado' : 'En Proceso' }}</div>
                    </div>
                    <div class="mt-6">
                        <a href="{{ route('depositos.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md">Volver a la Lista</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
