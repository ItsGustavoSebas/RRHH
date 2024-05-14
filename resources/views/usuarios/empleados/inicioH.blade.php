<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Horarios de ' . $empleado->usuario->name) }}
            </h2>
            @if($diasTrabajo->isEmpty())
                @can('Asignar Horarios a Empleado')
                    <a class="px-3 py-2 bg-indigo-600 font-bold text-white rounded-lg"
                        href="{{ route('empleados.asignarHorario', $empleado->usuario->id) }}">ASIGNAR HORARIOS</a>
                @endcan
            @endif
        </div>
    </x-slot>

    <table class="min-w-full border-collapse block md:table">
        <thead class="block md:table-header-group">
            <tr
                class="border border-grey-500 md:border-none block md:table-row absolute -top-full md:top-auto -left-full md:left-auto  md:relative ">
                <th
                    class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                    Dia</th>
                <th
                    class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                    Hora de Inicio</th>
                <th
                    class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                    Hora de Finalizacion</th>
                <th
                    class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                    Hora de Atraso</th>
                <th
                    class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                    Acciones</th>
            </tr>
        </thead>
        <tbody class="block md:table-row-group">
            @foreach ($diasTrabajo as $diaTrabajo)
                @php
                    $hasHorario = $diaTrabajo->Horario_Empleados->isNotEmpty();
                @endphp
                <tr class="bg-white border border-grey-500 md:border-none block md:table-row">
                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                        <span class="inline-block w-1/3 md:hidden font-bold">Dia</span>
                        {{ $diaTrabajo->Nombre }}
                    </td>
                    @if ($hasHorario)
                        <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                            <span class="inline-block w-1/3 md:hidden font-bold">Hora de Inicio</span>
                            {{ $diaTrabajo->Horario_Empleados->first()->Horario->HoraInicio }}
                        </td>
                        <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                            <span class="inline-block w-1/3 md:hidden font-bold">Hora de Finalización</span>
                            {{ $diaTrabajo->Horario_Empleados->first()->Horario->HoraFin }}
                        </td>
                        <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                            <span class="inline-block w-1/3 md:hidden font-bold">Hora de Atraso</span>
                            {{ $diaTrabajo->Horario_Empleados->first()->Horario->HoraLimite }}
                        </td>
                    @else
                        <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell" colspan="3">
                            No se asignó horario para este día
                        </td>
                    @endif
                    @if ($loop->first && $hasHorario)
                        <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"
                            rowspan="{{ $diasTrabajo->count() }}">
                            <div class="flex justify-start gap-4"><span
                                    class="inline-block w-1/3 md:hidden font-bold">Acciones</span>
                                @can('Editar Horarios de Empleado')
                                    <a href="{{ route('empleados.editarH', $empleado->usuario->id) }}"
                                        class="bg-green-400 px-2 py-2 rounded-lg" title="Editar">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </a>
                                @endcan
                                @can('Eliminar Horarios de Empleado')
                                    <div>
                                        <form id="formEliminar_{{ $empleado->usuario->id }}"
                                            action="{{ route('empleados.eliminarH', $empleado->usuario->id) }}"
                                            method="POST">
                                            @csrf
                                            <button type="button" class="bg-red-500 px-2 py-2 rounded-lg" title="Eliminar"
                                                onclick="confirmarEliminacion('{{ $empleado->usuario->id }}')">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                @endcan
                            </div>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
    <script>
        @if (Session::has('eliminado'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
            }
            toastr.success("{{ session('eliminado') }}")
        @endif
        @if (Session::has('actualizado'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
            }
            toastr.success("{{ session('actualizado') }}")
        @endif
        @if (Session::has('creado'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
            }
            toastr.success("{{ session('creado') }}")
        @endif
        @if (Session::has('error'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
            }
            toastr.error("{{ session('error') }}")
        @endif
    </script>
</x-app-layout>
