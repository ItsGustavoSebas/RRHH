<x-app-layout>
    <x-slot name="header">
        <div class = "flex flex-wrap justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Evaluación del personal') }}
            </h2>
            @can('Crear Departamentos')
            <a class = "px-3 py-2 bg-indigo-600 font-bold text-white rounded-lg"
                href="{{ route('departamentos.crear') }}">CREAR DEPARTAMENTO</a>
            @endcan
        </div>
    </x-slot>

    <title>Criterios de evaluación del personal</title>

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
                    Cargo</th>    
                <th
                    class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                    Departamento</th>    
                <th
                    class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                    Asistencias Esperadas</th>
                <th
                    class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                    Asistencias Puntuales</th>  
                <th
                    class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                    Asistencias Atrasadas</th>  
                <th
                    class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                    Asistencias Injustificadas</th>
                <th
                    class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                    Asistencias Justificada</th>   
                <th
                    class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                    Mes</th>    
                <th
                    class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                    Año</th>        
                <th
                    class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                    Puntaje</th>     
                <th
                    class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                    Acciones</th>
            </tr>
        </thead>
        <tbody class="block md:table-row-group">
            @foreach ($calificaciones_Empleados as $calificaciones_Empleado)
                <tr class="bg-white border border-grey-500 md:border-none block md:table-row">
                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span
                            class="inline-block w-1/3 md:hidden font-bold">ID</span>{{ $calificaciones_Empleado->id }}</td>
                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span
                            class="inline-block w-1/3 md:hidden font-bold">Nombre</span>{{ $calificaciones_Empleado->empleado->usuario->name }}</td>
                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span
                            class="inline-block w-1/3 md:hidden font-bold">Cargo</span>{{ $calificaciones_Empleado->empleado->cargo->nombre }}</td>     
                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span
                            class="inline-block w-1/3 md:hidden font-bold">Departamento</span>{{ $calificaciones_Empleado->empleado->departamento->nombre }}</td>    
                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span
                            class="inline-block w-1/3 md:hidden font-bold">Asistencias Esperadas</span>{{ $calificaciones_Empleado->cantAsisTotalesEsperadas }}</td>  
                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span
                            class="inline-block w-1/3 md:hidden font-bold">Asistencias Puntuales</span>{{ $calificaciones_Empleado->cantAsisPuntuales }}</td>
                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span
                            class="inline-block w-1/3 md:hidden font-bold">Asistencias Atrasadas</span>{{ $calificaciones_Empleado->cantAsisAtraso }}</td>    
                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span
                            class="inline-block w-1/3 md:hidden font-bold">Asistencias Injustificadas</span>{{ $calificaciones_Empleado->cantFaltInjustificada }}</td>  
                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span
                            class="inline-block w-1/3 md:hidden font-bold">Asistencias Justificada</span>{{ $calificaciones_Empleado->cantFaltaJustificada }}</td>   
                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span
                            class="inline-block w-1/3 md:hidden font-bold">Mes</span>{{ $calificaciones_Empleado->mes }}</td>        
                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span
                            class="inline-block w-1/3 md:hidden font-bold">Año</span>{{ $calificaciones_Empleado->anio }}</td>      
                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span
                            class="inline-block w-1/3 md:hidden font-bold">Puntaje</span>{{ $calificaciones_Empleado->puntaje }}</td>                                                                                                                  
                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                        {{-- <div class="flex flex-wrap">
                            <span class="inline-block w-1/3 md:hidden font-bold">Acciones</span>
                            @can('Editar Departamentos')
                            <a href="{{ route('departamentos.editar', $departamento->id) }}"
                                class = "bg-green-400 px-2 py-2 rounded-lg" title="Editar">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </a>
                            @endcan
                            @can('Eliminar Departamentos')
                            <div>
                                <form id="formEliminar_{{ $departamento->id }}" 
                                    action="{{ route('departamentos.eliminar', $departamento->id) }}" method="POST">
                                    @csrf
                                    <button type="button" class="bg-red-500 px-2 py-2 rounded-lg" title="Eliminar"
                                        onclick="confirmarEliminacion('{{ $departamento->id }}')">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                            @endcan
                        </div> --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
 
</x-app-layout>
