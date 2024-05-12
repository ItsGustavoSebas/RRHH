<x-app-layout>
    <x-slot name="header">
        <div class = "flex flex-wrap justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('LISTA DE ENTREVISTAS') }}
            </h2>
         
 
        </div>

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
                                Entrevistado</th>        
                            <th
                                class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                                Fecha Inicio</th>
                            <th
                                class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                                Hora</th>
                            <th
                                class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                                Fecha Fin</th>
                            <th
                                class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                                Detalles</th>   
                            <th
                                class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                                Iniciado por</th>   
                            <th
                                class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                                Puntaje</th>             
                            <th
                                class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                                Acciones</th>             

  
                                                 
                        </tr>

                    </thead>

                    
                    <tbody class="block md:table-row-group">

                    @if (!is_null($entrevistas))
                        @foreach ($entrevistas as $entrevista)
                        <tr class="bg-white border border-grey-500 md:border-none block md:table-row">
                            <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span
                                    class="inline-block w-1/3 md:hidden font-bold">ID</span>{{ $entrevista->id }}</td>
                            <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span
                                    class="inline-block w-1/3 md:hidden font-bold">Nombre del entrevistado</span>{{ $entrevista->postulante->usuario->name }}</td>
                            <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span
                                    class="inline-block w-1/3 md:hidden font-bold">Fecha de inicio</span>{{ $entrevista->fecha_inicio }}</td>    
                            <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span
                                    class="inline-block w-1/3 md:hidden font-bold">Hora de la entrevista</span>{{ $entrevista->hora }}</td>           
                            <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span
                                    class="inline-block w-1/3 md:hidden font-bold">Fecha de finalización</span>{{ $entrevista->fecha_fin }}</td>
                            <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span
                                    class="inline-block w-1/3 md:hidden font-bold">Detalles</span>{{ $entrevista->detalles }}</td>
                            <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span
                                    class="inline-block w-1/3 md:hidden font-bold">Iniciado por</span>{{ $entrevista->usuario->name }}</td>      
                            <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                                        <span class="inline-block w-1/3 md:hidden font-bold">Puntaje</span>
                                        {{ $entrevista->puntos ?? 'Sin puntaje' }}
                            </td>
                                                   
                                                                                                          
                            <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                                <div class="flex flex-wrap">
                                    <span class="inline-block w-1/3 md:hidden font-bold">Acciones</span>

                

                                    <button id="openModalBtn" class="bg-green-400 px-2 py-2 rounded-lg" title="Puntos">
                                        <i class="fas fa-star"></i>
                                    </button>
                                    
                                 
                                    <a href="{{ route('entrevistas.editar', $entrevista->id) }}"
                                        class = "bg-green-400 px-2 py-2 rounded-lg" title="Editar">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </a>
                                 
                                    
                                    <div class="flex flex-wrap">
                                        <div>
                                            <form id="formEliminar_{{ $entrevista->id }}"
                                                action="{{ route('entrevistas.eliminar', $entrevista->id) }}" method="POST">
                                                @csrf
                                                <button type="button" class="bg-red-500 px-2 py-2 rounded-lg" title="Eliminar"
                                                onclick="confirmarEliminacion('{{ $entrevista->id }}')">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                            </form>
                                        </div>
                                    </div>
                                
                                </div>
                            </td>

                        
                            

                            <style>
                                #evaluarBtn {
                                    background-color: #4CAF50;
                                    color: white;
                                    padding: 14px 20px;
                                    margin: 8px 0;
                                    border: none;
                                    cursor: pointer;
                                    width: 100%;
                                    border-radius: 5px;
                                    font-size: 16px;
                                }
                            
                                #evaluarBtn:hover {
                                    background-color: #45a049;
                                }
                            
                                .input-description {
                                    font-weight: bold;
                                }
                            
                                .close {
                                    color: red;
                                    font-weight: bold;
                                    font-size: 35px; /* Ajusta el tamaño del icono de cierre */
                                    cursor: pointer;
                                }
                            
                                .close:hover {
                                    color: darkred; /* Cambia el color al pasar el mouse sobre el icono de cierre */
                                }
                            </style>
                            
     
                            
                            <!-- Modal -->
                            <div id="myModal" class="modal text-center" style="display: none;">
                                <div class="modal-content">
                                    <span class="close close-modal">&times;</span>
                                    <p class="input-description"><strong>Introducir puntaje:</strong> (Entre 1 y 100)</p>
                                    <form action="{{ route('entrevistas.puntuar', $entrevista->id) }}" method="POST">
                                        @csrf
                                        <input type="number" name="puntos" placeholder="Puntaje (1-100)" min="1" max="100" required>
                                        <button id="evaluarBtn" type="submit">Puntuar</button>
                                    </form>
                                </div>
                            </div>
                            
                            <!-- JavaScript para abrir y cerrar el modal -->
                            <script>
                                // Obtener el modal
                                var modal = document.getElementById("myModal");
                            
                                // Obtener el botón que abre el modal
                                var btn = document.getElementById("openModalBtn");
                            
                                // Obtener el botón de cerrar del modal
                                var span = document.getElementsByClassName("close")[0];
                            
                                // Cuando se presiona el botón, abrir el modal
                                btn.onclick = function () {
                                    modal.style.display = "block";
                                }
                            
                                // Cuando se presiona en la 'x' del modal, cerrarlo
                                span.onclick = function () {
                                    modal.style.display = "none";
                                }
                            
                                // Cuando se presiona fuera del modal, cerrarlo
                                window.onclick = function (event) {
                                    if (event.target == modal) {
                                        modal.style.display = "none";
                                    }
                                }
                            </script>
                            
                            

                                                      
                        </tr>
                        @endforeach
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