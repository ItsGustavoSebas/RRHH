<x-app-layout>
    <x-slot name="header">
        {{-- <div class = "flex flex-wrap justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('POSTULANTE') }}
            </h2>
            <div>
                <a href="{{ route('excelpostulante') }}"
                    class="bg-orange-500 hover:bg-orange-600 text-white font-bold px-4 py-2 shadow mr-4">
                    Excel
                </a>
                <a href="{{ route('pdfpostulante') }}"
                    class="bg-red-500 hover:bg-red-600 text-white font-bold px-4 py-2 shadow mr-4">
                    PDF
                </a>
                <a href="{{ route('htmlpostulante') }}"
                    class="bg-blue-500 hover:bg-blue-600 text-white font-bold px-4 py-2 shadow mr-4">
                    HTML
                </a>
                <a href="{{ route('csvpostulante') }}"
                    class="bg-gray-500 hover:bg-gray-600 text-white font-bold px-4 py-2 shadow mr-4">
                    CSV
                </a>
            </div>
 
 
        </div> --}}

        <div>
            <div>
             
    
                <table class="min-w-full border-collapse block md:table">
                    <thead class="block md:table-header-group">
                        <tr
                            class="border border-grey-500 md:border-none block md:table-row absolute -top-full md:top-auto -left-full md:left-auto  md:relative ">
                            <th
                                class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                                ID</th>
                            <th
                                class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                                Foto</th>
                            <th
                                class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                                Fecha de nacimiento</th>
                            <th
                                class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                                Nacionalidad</th>        
                            <th
                                class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                                Habilidades</th>    
                            <th
                                class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                                Fuente de contratación</th>      
                            <th
                                class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                                Puesto elegido</th>     
                            <th
                                class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                                Idioma secundario</th>                                      
                            <th
                                class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                                Acciones</th>      
                                                 
                        </tr>

                    </thead>
                    <tbody class="block md:table-row-group">

                    @if (!is_null($postulante))
                      
                        <tr class="bg-white border border-grey-500 md:border-none block md:table-row">
                            <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span
                                    class="inline-block w-1/3 md:hidden font-bold">ID</span>{{ $postulante->ID_Usuario }}</td>

                                    
                            <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">

                              <div class="flex">
                                <span class="inline-block w-1/3 md:hidden font-bold">Foto</span>
                                @if ($postulante->ruta_imagen_e)
                                    <img id="imagen" src="{{ asset($postulante->ruta_imagen_e) }}"
                                    class="w-16 h-16 object-cover rounded-full" alt="placeholder"> {{-- style="width:100px; height:100px;"  --}}
                                @else
                                    <span>Null</span>
                                @endif
                               </div>
                               
                            </td>



                            <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span
                                     class="inline-block w-1/3 md:hidden font-bold">Fecha de nacimiento</span>{{ $postulante->fecha_de_nacimiento }}</td>        
                            <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span
                                    class="inline-block w-1/3 md:hidden font-bold">Nacionalidad</span>{{ $postulante->nacionalidad }}</td>
                            <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span
                                    class="inline-block w-1/3 md:hidden font-bold">Habilidades</span>{{ $postulante->habilidades }}</td>
                            <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span
                                    class="inline-block w-1/3 md:hidden font-bold">Fuente de contratación</span>{{ $postulante->ID_Fuente_De_Contratacion }}</td>       
                            <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span
                                    class="inline-block w-1/3 md:hidden font-bold">Puesto elegido</span>{{ $postulante->ID_Puesto_Disponible }}</td>   
                            <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span
                                    class="inline-block w-1/3 md:hidden font-bold">Puesto elegido</span>{{ $postulante->ID_Idioma }}</td>                                                                                          
                            <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                                <div class="flex flex-wrap">
                                    <span class="inline-block w-1/3 md:hidden font-bold">Acciones</span>
                                    
                                 
                                    <a href="{{ route('postulantes.editarGES', ['id' => auth()->id()]) }}"
                                        class = "bg-green-400 px-2 py-2 rounded-lg" title="Editar">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </a>
                                    
                                    
                                
                                </div>
                            </td>
                        </tr>
                 
                    @else
                        
                    @endif                        
             
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