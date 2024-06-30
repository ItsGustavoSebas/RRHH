<!-- resources/views/depositos/depositar.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Depositar Dinero') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <form action="{{ route('depositos.procesarDeposito', $deposito->id) }}" method="POST">
                    @csrf
                    <div class="p-6">
                        <div class="mb-4">
                            <h3 class="text-lg font-medium text-gray-900">Información del Depósito</h3>
                            <p class="mt-1 text-sm text-gray-600">Detalles del depósito a realizar.</p>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Empleado</label>
                            <div class="mt-1 text-sm text-gray-900">{{ $deposito->empleado->usuario->name }}</div>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Monto</label>
                            <div class="mt-1 text-sm text-gray-900">{{ $deposito->monto }}</div>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Fecha</label>
                            <div class="mt-1 text-sm text-gray-900">{{ $deposito->fecha }}</div>
                        </div>
                        <div class="mt-4">
                            <label for="numero_cuenta" class="block text-sm font-medium text-gray-700">Número de Cuenta</label>
                            <input type="text" name="numero_cuenta" id="numero_cuenta" class="form-input mt-1 block w-full" maxlength="16" required>
                        </div>
                        <div class="mt-6">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Depositar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
