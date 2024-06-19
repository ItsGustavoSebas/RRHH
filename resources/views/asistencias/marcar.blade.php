<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Horarios de ' . $empleado->usuario->name) }}
            </h2>
        </div>
    </x-slot>

    <table class="min-w-full border-collapse block md:table">
        <thead class="block md:table-header-group">
            <tr class="border border-grey-500 md:border-none block md:table-row absolute -top-full md:top-auto -left-full md:left-auto  md:relative">
                <th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                    Día
                </th>
                <th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                    Hora de Inicio
                </th>
                <th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                    Hora de Finalización
                </th>
                <th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                    Hora de Atraso
                </th>
                <th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                    Marcar Asistencia
                </th>
            </tr>
        </thead>
        <tbody class="block md:table-row-group">
            @foreach ($diasTrabajo as $diaTrabajo)
                @php
                    $hasHorario = $diaTrabajo;
                    $horaAjustada = \Carbon\Carbon::now()->toTimeString();
                @endphp
                <tr class="bg-white border border-grey-500 md:border-none block md:table-row">
                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                        <span class="inline-block w-1/3 md:hidden font-bold">Día</span>
                        {{ $diaTrabajo->dia_horario_empleado->DiaTrabajo->Nombre }}
                    </td>
                    @if ($hasHorario)
                        <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                            <span class="inline-block w-1/3 md:hidden font-bold">Hora de Inicio</span>
                            {{ $diaTrabajo->Horario->HoraInicio }}
                        </td>
                        <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                            <span class="inline-block w-1/3 md:hidden font-bold">Hora de Finalización</span>
                            {{ $diaTrabajo->Horario->HoraFin }}
                        </td>
                        <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                            <span class="inline-block w-1/3 md:hidden font-bold">Hora de Atraso</span>
                            {{ $diaTrabajo->Horario->HoraLimite }}
                        </td>
                    @else
                        <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell" colspan="3">
                            No se asignó horario para este día
                        </td>
                    @endif
                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                        @if ($diaTrabajo->dia_horario_empleado->DiaTrabajo->id == $diaTrabajoActual->id)
                            @php
                                $horaInicio = \Carbon\Carbon::parse($diaTrabajo->Horario->HoraInicio)->toTimeString();
                                $horaFin = \Carbon\Carbon::parse($diaTrabajo->Horario->HoraFin)->toTimeString();
                            @endphp
                            @if (!$asistenciaYaExiste && $horaAjustada >= $horaInicio && $horaAjustada <= $horaFin)
                                <div class="flex justify-start gap-4">
                                    <span class="inline-block w-1/3 md:hidden font-bold">Marcar Asistencia</span>
                                    @can('Marcar Asistencia')
                                        <form
                                            action="{{ route('asistencias.guardarAsistencias', ['idEmpleado' => $empleado->usuario->id, 'idDiaTrabajo' => $diaTrabajo->dia_horario_empleado->DiaTrabajo->id]) }}"
                                            method="POST">
                                            @csrf
                                            <button type="submit" class="bg-green-400 px-1 py-1 rounded-lg"
                                                title="Marcar Asistencia">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                            @else
                                <div class="flex justify-start gap-4">
                                    <span class="inline-block w-1/3 md:hidden font-bold">Marcar Asistencia</span>
                                </div>
                            @endif
                        @endif
                    </td>
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
