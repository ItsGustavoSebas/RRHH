<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Sueldos de Empleados') }}
            </h2>
            <div>
                <a href="{{ route('sueldos.descargarExcel', ['fecha_inicio' => request('fecha_inicio'), 'fecha_fin' => request('fecha_fin')]) }}"
                    class="bg-green-500 hover:bg-green-600 text-white font-bold px-4 py-2 shadow mr-4">
                    Descargar Excel
                </a>
                <a href="{{ route('sueldos.descargarPdf', ['fecha_inicio' => request('fecha_inicio'), 'fecha_fin' => request('fecha_fin')]) }}"
                    class="bg-red-500 hover:bg-red-600 text-white font-bold px-4 py-2 shadow mr-4">
                    Descargar PDF
                </a>
            </div>
        </div>
    </x-slot>
    <table class="min-w-full border-collapse block md:table">
        <thead class="block md:table-header-group">
            <tr
                class="border border-grey-500 md:border-none block md:table-row absolute -top-full md:top-auto -left-full md:left-auto md:relative">
                <th
                    class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                    Empleado</th>
                <th
                    class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                    Fecha de Nacimiento</th>
                <th
                    class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                    Cargo</th>
                <th
                    class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                    Fecha de Ingreso</th>
                <th
                    class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                    Días Trabajados</th>
                <th
                    class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                    Horas/Día pagadas</th>
                <th
                    class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                    Haber Básico</th>
                <th
                    class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                    Bono Antigüedad</th>
                <th
                    class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                    Horas Extras</th>
                <th
                    class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                    Pago por Horas Extras</th>
                <th
                    class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                    Dominical y Feriado</th>
                <th
                    class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                    Pago Dominical y Feriado</th>

                <th
                    class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                    Faltas</th>
                <th
                    class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                    Descuentos por Faltas</th>
                <th
                    class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                    AFP (12.71%)</th>

                <th
                    class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                    Seguro (10%)</th>

                <th
                    class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                    Total Descuento</th>
                <th
                    class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                    Total Ganado</th>
                <th
                    class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                    Acciones</th>
            </tr>
        </thead>
        <tbody class="block md:table-row-group">
            @foreach ($empleadosCalculados as $key => $empleado)
                @php
                    $bgColor = $key % 2 == 0 ? 'bg-gray-300' : 'bg-white';
                @endphp
                <tr class="{{ $bgColor }} border border-grey-500 md:border-none block md:table-row">
                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                        {{ $empleado['empleado']->usuario->name }}</td>
                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                        {{ $empleado['empleado']->fechanac }}</td>
                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                        {{ $empleado['empleado']->cargo->nombre }}</td>
                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                        {{ $empleado['empleado']->created_at }}</td>
                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                        {{ $empleado['dias_trabajados'] }}</td>
                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                        {{ $empleado['empleado']->sueldo->horas_diarias }}</td>
                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                        {{ number_format($empleado['haber_basico'], 2) }}</td>
                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                        {{ number_format($empleado['bono_antiguedad'], 2) }}</td>
                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                        {{ number_format($empleado['horas_extras'], 2) }}</td>
                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                        {{ number_format($empleado['pago_por_horas_extras'], 2) }}</td>
                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                        {{ $empleado['dominical_feriado'] }}</td>
                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                        {{ number_format($empleado['pago_dominical_feriado'], 2) }}</td>
                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                        {{ $empleado['faltas_injustificadas'] }}</td>
                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                        {{ number_format($empleado['descuento_faltas'], 2) }}</td>
                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                        {{ number_format($empleado['aporte_a_gestora'], 2) }}</td>
                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                        {{ number_format($empleado['seguro'], 2) }}</td>
                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                        {{ number_format($empleado['total_descuento'], 2) }}</td>
                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                        {{ number_format($empleado['total_ganado'], 2) }}</td>
                        <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                            <form action="{{ route('sueldos.guardar') }}" method="POST">
                                @csrf
                                <input type="hidden" name="empleado_id" value="{{ $empleado['empleado']->ID_Usuario }}">
                                <input type="hidden" name="fecha" value="{{ now()->toDateString() }}">
                                <input type="hidden" name="depositado" value="0">
                                <input type="hidden" name="monto" value="{{ $empleado['total_ganado'] }}">
                                <input type="hidden" name="fecha_inicio" value="{{ request('fecha_inicio') }}">
                                <input type="hidden" name="fecha_fin" value="{{ request('fecha_fin') }}">
                                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold px-4 py-2 shadow">
                                    Depositar
                                </button>
                            </form>
                        </td>
                </tr>
            @endforeach
        </tbody>
    </table>
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
    </script>
</x-app-layout>
