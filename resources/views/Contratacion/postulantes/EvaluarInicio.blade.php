<x-app-layout>
    <x-slot name="header">
        <div class = "flex flex-wrap justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Puntos por sección del postulante: ') . $postulante->usuario->name }}
                

            </h2>

           
 
 
        </div> 
        <br>

        <div>
            <div>
             
    
                <table class="min-w-full border-collapse block md:table">
                    <thead class="block md:table-header-group">
                        <tr
                            class="border border-grey-500 md:border-none block md:table-row absolute -top-full md:top-auto -left-full md:left-auto  md:relative ">
      
     

                            <th
                                class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                                Educaciones</th>
                            <th
                                class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                                Reconocimientos</th>
                            <th
                                class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                                Experiencias</th>        

                            <th
                                class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                                Referencias</th>    
                                
                            <th
                                class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                                Idioma</th>
                             
                                                 
                        </tr>

                    </thead>
                    <tbody class="block md:table-row-group">

                
                      

        
                            

                            <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span
                                    class="inline-block w-1/3 md:hidden font-bold">Educaciones</span>Puntos: {{ $calificaciones->ptEducacion }}
                                    <a href="{{ route('postulantes.evaluacionEducacion', $postulante->ID_Usuario) }}"
                                        class = "bg-green-400 px-2 py-2 rounded-lg" title="Visualizar">
                                        <i class="far fa-eye"></i>

                                    </a>
                            </td>

                            <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span
                                class="inline-block w-1/3 md:hidden font-bold">Reconocimientos</span>Puntos: {{ $calificaciones->ptReconocimiento }}
                                <a href="{{ route('postulantes.evaluacionReconocimiento', $postulante->ID_Usuario) }}"
                                    class = "bg-green-400 px-2 py-2 rounded-lg" title="Visualizar">
                                    <i class="far fa-eye"></i>

                                </a>
                                     
                                    
                            </td>    

                            <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span
                                class="inline-block w-1/3 md:hidden font-bold">Experiencias</span>Puntos: {{ $calificaciones->ptExperiencia }}
                                <a href="{{ route('postulantes.evaluacionExperiencia', $postulante->ID_Usuario) }}"
                                    class = "bg-green-400 px-2 py-2 rounded-lg" title="Visualizar">
                                    <i class="far fa-eye"></i>

                                </a>
                            </td>


                            <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span
                                class="inline-block w-1/3 md:hidden font-bold">Referencias</span>Puntos: {{ $calificaciones->ptReferencia }}
                                <a href="{{ route('postulantes.evaluacionReferencia', $postulante->ID_Usuario) }}"
                                    class = "bg-green-400 px-2 py-2 rounded-lg" title="Visualizar">
                                    <i class="far fa-eye"></i>

                                </a>
                            </td>

                            
                            <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span
                                class="inline-block w-1/3 md:hidden font-bold">Idioma</span>Puntos: {{ $calificaciones->ptIdioma }}
               
                            </td>

                           
                                    
                          
                        </tr>
                                 
             
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