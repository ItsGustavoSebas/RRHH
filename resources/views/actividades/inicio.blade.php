<!-- resources/views/actividades/inicio.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('LISTA DE ACTIVIDADES') }}
            </h2>
            @can('Crear Actividades')
            <a href="{{ route('actividades.crear') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg">
                Crear Actividad
            </a>
        @endcan
        </div>
    </x-slot>

    <div>
        <div>
            <table class="min-w-full border-collapse block md:table">
                <thead class="block md:table-header-group">
                    <tr class="border border-grey-500 md:border-none block md:table-row absolute -top-full md:top-auto -left-full md:left-auto md:relative">
                        <th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">ID</th>
                        <th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">Nombre</th>
                        <th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">Descripción</th>
                        <th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">Fecha Inicio</th>
                        <th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">Hora Inicio</th>
                        <th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">Fecha Fin</th>
                        <th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">Hora Fin</th>
                        <th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">Acciones</th>
                    </tr>
                </thead>
                <tbody class="block md:table-row-group">
                    @if (!is_null($actividades))
                        @foreach ($actividades as $actividad)
                            <tr class="bg-white border border-grey-500 md:border-none block md:table-row">
                                <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                                    <span class="inline-block w-1/3 md:hidden font-bold">ID</span>{{ $actividad->id }}
                                </td>
                                <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                                    <span class="inline-block w-1/3 md:hidden font-bold">Nombre</span>{{ $actividad->nombre }}
                                </td>
                                <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                                    <span class="inline-block w-1/3 md:hidden font-bold">Descripción</span>{{ $actividad->descripcion }}
                                </td>
                                <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                                    <span class="inline-block w-1/3 md:hidden font-bold">Fecha Inicio</span>{{ \Carbon\Carbon::parse($actividad->fecha_inicio)->format('d-m-Y') }}
                                </td>
                                <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                                    <span class="inline-block w-1/3 md:hidden font-bold">Hora Inicio</span>{{ \Carbon\Carbon::parse($actividad->hora_inicio)->format('H:i') }}
                                </td>
                                <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                                    <span class="inline-block w-1/3 md:hidden font-bold">Fecha Fin</span>{{ \Carbon\Carbon::parse($actividad->fecha_fin)->format('d-m-Y') }}
                                </td>
                                <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                                    <span class="inline-block w-1/3 md:hidden font-bold">Hora Fin</span>{{ \Carbon\Carbon::parse($actividad->hora_fin)->format('H:i') }}
                                </td>
                                <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                                    <div class="flex flex-wrap">
                                        <span class="inline-block w-1/3 md:hidden font-bold">Acciones</span>
                                        @can('Editar Actividades')
                                            <a href="{{ route('actividades.editar', $actividad->id) }}" class="bg-green-400 px-2 py-2 rounded-lg" title="Editar">
                                                <i class="fa-regular fa-pen-to-square"></i>
                                            </a>
                                        @endcan
                                        @can('Eliminar Actividades')
                                            <form id="formEliminar_{{ $actividad->id }}" action="{{ route('actividades.eliminar', $actividad->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="bg-red-500 px-2 py-2 rounded-lg" title="Eliminar" onclick="confirmarEliminacion('{{ $actividad->id }}')">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8" class="p-2 md:border md:border-grey-500 text-left block md:table-cell">No hay actividades registradas</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function confirmarEliminacion(id) {
            if (confirm('¿Estás seguro de que deseas eliminar esta actividad?')) {
                document.getElementById('formEliminar_' + id).submit();
            }
        }
    </script>
</x-app-layout>
