<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Mis Depósitos') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <table class="min-w-full bg-white">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="w-1/3 px-4 py-2">Empleado</th>
                            <th class="w-1/3 px-4 py-2">Fecha</th>
                            <th class="w-1/3 px-4 py-2">Estado</th>
                            <th class="w-1/3 px-4 py-2">Monto</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($depositos as $deposito)
                            <tr>
                                <td class="border px-4 py-2">{{ $deposito->empleado->usuario->name }}</td>
                                <td class="border px-4 py-2">{{ $deposito->fecha }}</td>
                                <td class="border px-4 py-2">{{ $deposito->depositado ? 'Realizado' : 'En Proceso' }}</td>
                                <td class="border px-4 py-2">{{ $deposito->monto }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
