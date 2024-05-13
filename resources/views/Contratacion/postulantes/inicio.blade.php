<x-app-layout>
    <x-slot name="header">
        <div class = "flex flex-wrap justify-between">



            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('POSTULANTE') }}
            </h2>

 

            <div>
              

                <a href="{{ route('excelpostulante') }}"
                    class="bg-green-500 hover:bg-green-600 text-white font-bold px-4 py-2 shadow mr-4">
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
            {{-- <a class = "px-3 py-2 bg-indigo-600 font-bold text-white rounded-lg"
                href="{{ route('postulantes.crearSIG') }}">Añadir Educación</a> --}}
 
        </div>

        <div class="flex flex-wrap justify-center items-center mt-6 mb-6">
            <button id="openModalBtn" class="px-3 py-2 bg-indigo-600 font-bold text-white rounded-lg">EVALUAR POSTULANTES AUTOMATICAMENTE</button>
        </div>
          
  
<style>
    #myModal {
  display: none; /* Ocultar el modal por defecto */
}

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
<!-- Modal -->
<div id="myModal" class="modal text-center">
    <div class="modal-content">
        <span class="close close-modal">&times;</span>
        <p class="input-description"><strong>Introducir puntos de valor para cada apartado:</strong> (Dejar vacío para puntos de valor por defecto)</p>
        <form id="evaluarForm" action="{{ route('postulantes.evaluar') }}" method="POST">
            @csrf
            <input type="number" name="Puntos_Educaciones" placeholder="Valor Educaciones">
            <input type="number" name="Puntos_Reconocimientos" placeholder="Valor Reconocimientos">
            <input type="number" name="Puntos_Experiencias" placeholder="Valor Experiencias">
            <input type="number" name="Puntos_Referencias" placeholder="Valor Referencias">
            <input type="number" name="Puntos_Idioma" placeholder="Valor Idioma">
            <button type="submit" id="evaluarBtn" class="btn">Evaluar</button>

        </form>
    </div>
</div>

<br>


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



        <button id="ordenar-por-puntos" class="px-3 py-2 bg-green-600 font-bold text-white rounded-lg">Ordenar por Puntos</button>

        <select id="filtrarPorPuesto">
            <option value="" selected>Mostrar todos</option>
            @foreach ($puestosDisponibles as $puesto)
                <option value="{{ $puesto->id }}">{{ $puesto->nombre }}</option>
            @endforeach
        </select>

        <select id="filtrarPorEstado">
            <option value="" selected>Mostrar todos</option>
            <option value="ocultar_rechazados">Ocultar rechazados</option>
        </select>

        <script>
            document.getElementById('filtrarPorEstado').addEventListener('change', function() {
                var selectedOption = this.value;
                console.log('Selected option:', selectedOption); // Verifica el valor seleccionado
        
                var rows = document.querySelectorAll('.postulantes-table tbody tr');
        
                if (selectedOption === 'ocultar_rechazados') {
                    rows.forEach(function(row) {
                        var estado = row.querySelector('.estado-column').innerText.trim();
                        console.log('Estado es:', estado); // Verifica el estado obtenido
                        if (estado === 'Rechazado') {
                            row.style.display = 'none';
                        } else {
                            row.style.display = 'table-row';
                        }
                    });
                } else {
                    rows.forEach(function(row) {
                        row.style.display = 'table-row';
                    });
                }
            });
        </script>
        
        
        <script>
            document.getElementById('filtrarPorPuesto').addEventListener('change', function() {
                var selectedPuestoId = this.value;
                var rows = document.querySelectorAll('.postulantes-table tbody tr');
                rows.forEach(function(row) {
                    var puestoId = row.dataset.puestoId;
                    if (!selectedPuestoId || puestoId === selectedPuestoId) {
                        row.style.display = 'table-row';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var ordenAscendente = true; // Estado inicial para orden ascendente
        
                document.getElementById('ordenar-por-puntos').addEventListener('click', function() {
                    ordenarPorPuntos(ordenAscendente);
                    ordenAscendente = !ordenAscendente; // Cambiar el estado para la próxima vez
                });
            });
        
            function ordenarPorPuntos(ordenAscendente) {
                var table = document.querySelector('.postulantes-table');
                var tbody = table.querySelector('tbody');
                var rows = Array.from(tbody.querySelectorAll('tr'));
        
                rows.sort(function(rowA, rowB) {
                    var puntosA = parseInt(rowA.querySelector('.puntos-column').innerText);
                    var puntosB = parseInt(rowB.querySelector('.puntos-column').innerText);
                    if (ordenAscendente) {
                        return puntosA - puntosB; // Orden ascendente
                    } else {
                        return puntosB - puntosA; // Orden descendente
                    }
                });
        
                tbody.innerHTML = '';
                rows.forEach(function(row) {
                    tbody.appendChild(row);
                });
            }
        </script>
        
        
        

        


    </x-slot>

        <div>
     

            <div>
        
             
    
                <table class="min-w-full border-collapse block md:table postulantes-table">
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
                                Nombre</th>    
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
                                Nivel Idioma</th>     
                            <th
                                class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                                Puntos Evaluación</th> 
                            <th
                                class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                                Estado de postulación</th> 
                            <th
                                class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                                Puntaje de entrevista</th>      
                            <th
                                class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                                Acciones</th>  
                            <th
                                class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                                Acciones Contrato</th>   

                                                    
                    
                                                 
                        </tr>

                    </thead>
                    <tbody class="block md:table-row-group">

                    @if (!is_null($postulantes))
                      @foreach ($postulantes as $postulanteU)
                      <tr class="bg-white border border-grey-500 md:border-none block md:table-row" data-puesto-id="{{ $postulanteU->ID_Puesto_Disponible }}">
                            <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span
                                    class="inline-block w-1/3 md:hidden font-bold">ID</span>{{ $postulanteU->ID_Usuario }}</td>
                                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">

                                        <div class="flex">
                                          <span class="inline-block w-1/3 md:hidden font-bold">Foto</span>
                                          @if ($postulanteU->ruta_imagen_e)
                                              <img id="imagen" src="{{ asset($postulanteU->ruta_imagen_e) }}"
                                              class="w-16 h-16 object-cover rounded-full" alt="placeholder"> {{-- style="width:100px; height:100px;"  --}}
                                          @else
                                              <span>Null</span>
                                          @endif
                                         </div>
                                         
                                    </td>

                             
                            <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span
                                class="inline-block w-1/3 md:hidden font-bold">Nombre</span>{{ $postulanteU->usuario->name }}</td>      

                            <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span
                                     class="inline-block w-1/3 md:hidden font-bold">Fecha de nacimiento</span>{{ $postulanteU->fecha_de_nacimiento }}</td>        
                            <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span
                                    class="inline-block w-1/3 md:hidden font-bold">Nacionalidad</span>{{ $postulanteU->nacionalidad }}</td>
                            <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span
                                    class="inline-block w-1/3 md:hidden font-bold">Habilidades</span>{{ $postulanteU->habilidades }}</td>
                                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                                        <span class="inline-block w-1/3 md:hidden font-bold">Fuente de contratación</span>
                                        {{ $postulanteU->fuente_de_contratacion ? $postulanteU->fuente_de_contratacion->nombre : 'No especificado.' }}
                                    </td>
                                    
                                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                                        <span class="inline-block w-1/3 md:hidden font-bold">Puesto elegido</span>
                                        {{ $postulanteU->puesto_disponible ? $postulanteU->puesto_disponible->nombre : 'No especificado.' }}
                                    </td>
                                    
                                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                                        <span class="inline-block w-1/3 md:hidden font-bold">Segundo Idioma</span>
                                        {{ $postulanteU->idioma ? $postulanteU->idioma->nombre : 'No especificado' }}
                                    </td>

                                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                                        <span class="inline-block w-1/3 md:hidden font-bold">Nivel Idioma</span>
                                        {{ $postulanteU->nivel_idioma ? $postulanteU->nivel_idioma->categoria : 'No especificado' }}
                                    </td>   
                                    
                                    
                                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell puntos-column">
                                    <span class="inline-block w-1/3 md:hidden font-bold">Puntos Evaluación</span>
                                    {{ $postulanteU->puntos ?? 0 }}
                            </td>

                            <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell estado-column">
                                <span class="inline-block w-1/3 md:hidden font-bold">Estado</span>
                                @if ($postulanteU->estado === 1)
                                    Aceptado
                                @elseif ($postulanteU->estado === 0)
                                    Rechazado
                                @else
                                    En proceso
                                @endif
                            </td>

                            <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                                <span class="inline-block w-1/3 md:hidden font-bold">Puntaje de entrevista</span>
                                @php
                                    // Obtener el ID_Postulante del usuario actual
                                    $idPostulante = $postulanteU->ID_Usuario;
                            
                                    // Buscar la entrevista que coincide con el ID_Postulante
                                    $entrevista = App\Models\Entrevista::where('ID_Postulante', $idPostulante)->first();
                            
                                    // Mostrar los puntos si se encuentra la entrevista, de lo contrario mostrar 'Sin puntaje'
                                    echo $entrevista ? $entrevista->puntos : 'Sin puntaje';
                                @endphp
                            </td>


                            <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                                <div class="flex flex-wrap">
                                    <span class="inline-block w-1/3 md:hidden font-bold">Acciones</span>
                                    
                                 
                                    <a href="{{ route('postulantes.evaluarInicio', $postulanteU->ID_Usuario) }}" class="bg-yellow-400 px-2 py-2 rounded-lg" title="Evaluar Detalladamente">
                                        <i class="fas fa-search"></i>
                                    </a>


                                    <div>
                                        <form id="formEliminar1_{{ $postulanteU->ID_Usuario }}" 
                                            action="{{ route('postulantes.proceso', $postulanteU->ID_Usuario) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="bg-green-200 px-2 py-2 rounded-lg" title="Establecer postulación en proceso">
                                                <i class="fas fa-spinner fa-spin"></i> <!-- Ícono de una barra de carga -->
                                            </button>
                                        </form>
                                    </div>
                                    



                                    <a href="{{ route('entrevistas.crear', $postulanteU->ID_Usuario) }}" class="bg-green-400 px-2 py-2 rounded-lg" title="Entrevistar">
                                        <i class="fas fa-chalkboard-teacher"></i>
                                    </a>





                                    <div>
                                        <form id="formEliminar_{{ $postulanteU->ID_Usuario }}" 
                                            action="{{ route('postulantes.rechazar', $postulanteU->ID_Usuario) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="bg-red-400 px-2 py-2 rounded-lg" title="Rechazar postulante">
                                                <i class="fas fa-times"></i> <!-- Ícono de una X -->
                                            </button>
                                        </form>
                                    </div>








                                </div>

                            </td>

                            <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                                <div class="flex flex-wrap">
                                    <span class="inline-block w-1/3 md:hidden font-bold">Acciones Contrato</span>
                                    
                                 
    
                                    @if ($pre_contratos->where('ID_Postulante', $postulanteU->ID_Usuario)->first())
                                        <a href="{{ route('generarContratoPDF', $postulanteU->ID_Usuario) }}" class="bg-white px-2 py-2 rounded-lg" title="Generar PDF de contratación">
                                          <i class="fas fa-file-pdf"></i>
                                        </a>

                                        <a href="{{ route('precontratos.editar', $postulanteU->ID_Usuario) }}" class="bg-green-400 px-2 py-2 rounded-lg" title="Editar datos Pre Contrato">
                                          <i class="fas fa-edit"></i>
                                        </a>
                                    @else
                                        <a href="{{ route('precontratos.crear', $postulanteU->ID_Usuario) }}" class="bg-green-400 px-2 py-2 rounded-lg" title="Crear datos Pre Contrato">
                                          <i class="fas fa-file-pdf"></i>
                                        </a>  
                                    @endif
    
    
                                </div>

                            </td>

                      
                                                                                                                       
                          
                        </tr>
                        @endforeach
                    @else
                        
                    @endif                        
             
                    </tbody>
                </table>
            </div>
        </div>
        
  
    

    <script>
        @if (Session::has('eliminado'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
            }
            toastr.success("{{ session('eliminado') }}")
        @endif



        @if (Session::has('evaluados'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
            }
            toastr.success("{{ session('evaluados') }}")
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