<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Historial de Asistencia de {{ $empleado->usuario->name }}
        </h2>
    </x-slot>

    @if ($historialAsistencia->isEmpty())
        <p>No hay registros de asistencia para este empleado.</p>
    @else
        <table class="min-w-full border-collapse block md:table">
            <thead class="block md:table-header-group">
                <tr class="border border-grey-500 md:border-none block md:table-row absolute -top-full md:top-auto -left-full md:left-auto  md:relative ">
                    <th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                        Fecha
                    </th>
                    <th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                        Hora
                    </th>
                    <th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                        Estado
                    </th>
                </tr>
            </thead>
            <tbody class="block md:table-row-group">
                @foreach ($historialAsistencia as $asistencia)
                    <tr class="bg-white border border-grey-500 md:border-none block md:table-row">
                        <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                            <span class="inline-block w-1/3 md:hidden font-bold">Fecha</span>
                            {{ $asistencia->FechaMarcada }} 
                        </td>
                        <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                            <span class="inline-block w-1/3 md:hidden font-bold">Fecha</span>
                            {{ $asistencia->HoraMarcada }} 
                        </td>

                        <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                            <span class="inline-block w-1/3 md:hidden font-bold">Estado</span>
                            @if ($asistencia->Puntual)
                                Puntual
                            @elseif ($asistencia->Atraso)
                                Atraso
                            @elseif ($asistencia->FaltaInjustificada)
                                Falta Injustificada
                            @elseif ($asistencia->FaltaJustificada)
                                Falta Justificada
                            @else
                                N/A
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</x-app-layout>
