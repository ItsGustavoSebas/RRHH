<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Lista de Depósitos') }}
            </h2>
            @can('Crear Depósitos')
                <a href="{{ route('depositos.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md">Crear Depósito</a>
            @endcan
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
                            <th class="px-4 py-2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($depositos as $deposito)
                            <tr>
                                <td class="border px-4 py-2">{{ $deposito->empleado->usuario->name }}</td>
                                <td class="border px-4 py-2">{{ $deposito->fecha }}</td>
                                <td class="border px-4 py-2">{{ $deposito->depositado ? 'Realizado' : 'En Proceso' }}</td>
                                <td class="border px-4 py-2">{{ $deposito->monto }}</td>
                                <td class="border px-4 py-2">
                                    <div class="flex flex-col items-center space-y-2">
                                        @can('Ver Todos los Depósitos')
                                            <a href="{{ route('depositos.show', $deposito->id) }}" class="bg-green-500 text-white px-2 py-1 rounded-md">Ver</a>
                                        @endcan
                                        @can('Editar Depósitos')
                                            <a href="{{ route('depositos.edit', $deposito->id) }}" class="bg-yellow-500 text-white px-2 py-1 rounded-md">Editar</a>
                                        @endcan
                                        @if (!$deposito->depositado)
                                            @can('Depositar Dinero')
                                                <a href="{{ route('depositos.depositar', $deposito->id) }}" class="bg-blue-500 text-white px-2 py-1 rounded-md">Depositar</a>
                                            @endcan
                                        @endif
                                        @can('Eliminar Depósitos')
                                            <form action="{{ route('depositos.destroy', $deposito->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Está seguro de que desea eliminar este depósito?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded-md">Eliminar</button>
                                            </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
