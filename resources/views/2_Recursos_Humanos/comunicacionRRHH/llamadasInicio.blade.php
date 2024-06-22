<x-app-layout>
    <x-slot name="header">
        <div class = "flex flex-wrap justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Lista de llamadas de atención') }}
            </h2>

        </div>
    </x-slot>

    <title>Llamadas</title>

    <table class="min-w-full border-collapse block md:table">
        <thead class="block md:table-header-group">
            <tr
                class="border border-grey-500 md:border-none block md:table-row absolute -top-full md:top-auto -left-full md:left-auto  md:relative ">
                <th
                    class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                    ID</th>
                <th
                    class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                    Empleado</th>
                <th
                    class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                    Motivo</th>
                <th
                    class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                    Gravedad</th>
                <th
                    class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                    Fecha</th>
                <th
                    class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                    Acciones</th>
            </tr>
        </thead>
        <tbody class="block md:table-row-group">
            @foreach ($llamadas as $llamada)
                <tr class="bg-white border border-grey-500 md:border-none block md:table-row">

                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span
                            class="inline-block w-1/3 md:hidden font-bold">ID</span>{{ $llamada->id }}</td>

                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span
                            class="inline-block w-1/3 md:hidden font-bold">Empleado</span>{{ $llamada->empleado->usuario->name }}
                    </td>
                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span
                            class="inline-block w-1/3 md:hidden font-bold">Motivo</span>{{ $llamada->motivo }}
                    </td>
                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span
                            class="inline-block w-1/3 md:hidden font-bold">Gravedad</span>{{ $llamada->gravedad }}
                    </td>
                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span
                            class="inline-block w-1/3 md:hidden font-bold">Fecha</span>{{ $llamada->fecha }}
                    </td>


                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                        <div class="flex flex-wrap">
                            <span class="inline-block w-1/3 md:hidden font-bold">Acciones</span>
                            @can('Editar Departamentos')
                                <a href="{{ route('memorandumLlamada.editar', $llamada->id) }}"
                                    class = "bg-green-400 px-2 py-2 rounded-lg" title="Editar">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </a>
                            @endcan
                            @can('Eliminar Departamentos')
                                <div>
                                    <form id="formEliminar_{{ $llamada->id }}"
                                        action="{{ route('memorandumLlamada.eliminar', $llamada->id) }}" method="POST">
                                        @csrf
                                        <button type="button" class="bg-red-500 px-2 py-2 rounded-lg" title="Eliminar"
                                            onclick="confirmarEliminacion('{{ $llamada->id }}')">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            @endcan

                        </div>
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
