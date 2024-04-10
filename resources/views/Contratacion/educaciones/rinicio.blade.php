<x-app-layout>
    <x-slot name="header">
        <div class = "flex flex-wrap justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('LISTA DE EDUCACIONES') }}
            </h2>
         
            {{-- <a class = "px-3 py-2 bg-indigo-600 font-bold text-white rounded-lg"
                href="{{ route('marcas.crear') }}">CREAR MARCA</a> --}}
 
        </div>

        <div>
            <div>
                <div>
                    <h2 class="text-2xl font-semibold leading-tight">EDUCACIONES</h2>
                </div>
                <div class="my-2 flex sm:flex-row flex-col">
                    <div class="block relative">
                        <span class="h-full absolute inset-y-0 left-0 flex items-center pl-2">
                            <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current text-gray-500">
                                <path
                                    d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z">
                                </path>
                            </svg>
                        </span>
                        <input placeholder="Buscar" wire:model="filtro"
                            class="appearance-none rounded-r rounded-l sm:rounded-l-none border border-gray-400 border-b block pl-8 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none" />
                    </div>
        
                </div>
                <table class="min-w-full border-collapse block md:table">
                    <thead class="block md:table-header-group">
                        <tr
                            class="border border-grey-500 md:border-none block md:table-row absolute -top-full md:top-auto -left-full md:left-auto  md:relative ">
                            <th
                                class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                                ID</th>
                            <th
                                class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                                Nombre del colegio</th>
                            <th
                                class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                                Grado Diploma</th>
                            <th
                                class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                                Campo de estudio</th>        
                            <th
                                class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                                Fecha de finalización</th>    
                            <th
                                class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                                Notas adicionales</th>                           
                        </tr>

                    </thead>
                    <tbody class="block md:table-row-group">
                        @foreach ($educaciones as $educacion)
                            <tr class="bg-white border border-grey-500 md:border-none block md:table-row">
                                <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span
                                        class="inline-block w-1/3 md:hidden font-bold">ID</span>{{ $educacion->id }}</td>
                                <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span
                                        class="inline-block w-1/3 md:hidden font-bold">Nombre del colegio</span>{{ $educacion->nombre_colegio }}</td>
                                <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span
                                         class="inline-block w-1/3 md:hidden font-bold">Grado Diploma</span>{{ $educacion->grado_diploma }}</td>        
                                <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span
                                        class="inline-block w-1/3 md:hidden font-bold">Campo de estudio</span>{{ $educacion->campo_de_estudio }}</td>
                                <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span
                                        class="inline-block w-1/3 md:hidden font-bold">Fecha de finalización</span>{{ $educacion->fecha_de_finalizacion }}</td>
                                <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span
                                        class="inline-block w-1/3 md:hidden font-bold">Notas adicionales</span>{{ $educacion->notas_adicionales }}</td>       
                                <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span
                                        class="inline-block w-1/3 md:hidden font-bold">Postulante</span>{{ $educacion->ID_Postulante }}</td>                                                                                  
                                <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                                    <div class="flex flex-wrap">
                                        <span class="inline-block w-1/3 md:hidden font-bold">Acciones</span>
                                     
                                        <a href="{{ route('educaciones.editar', $educacion->id) }}"
                                            class = "bg-green-400 px-2 py-2 rounded-lg" title="Editar">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </a>
                                     
                                        
                                        <div class="flex flex-wrap">
                                            <div>
                                                <form id="formEliminar_{{ $educacion->id }}"
                                                    action="{{ route('educaciones.eliminar', $educacion->id) }}" method="POST">
                                                    @csrf
                                                    <button type="button" class="bg-red-500 px-2 py-2 rounded-lg" title="Eliminar"
                                                    onclick="confirmarEliminacion('{{ $educacion->id }}')">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                                </form>
                                            </div>
                                        </div>
                                    
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
    </x-slot>
    

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