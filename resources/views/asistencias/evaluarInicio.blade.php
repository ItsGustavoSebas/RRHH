<x-app-layout>
    <x-slot name="header">
        <div class = "flex flex-wrap justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Evaluación del personal') }}
            </h2>

        </div>

        <div class="flex flex-wrap justify-center items-center mt-6 mb-6">
            <button id="openModalBtn" class="px-3 py-2 bg-indigo-600 font-bold text-white rounded-lg">PESO DE
                PUNTUACIONES</button>
        </div>

        <style>
            #myModal {
                display: none;
                /* Ocultar el modal por defecto */
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
                font-size: 35px;
                /* Ajusta el tamaño del icono de cierre */
                cursor: pointer;
            }

            .close:hover {
                color: darkred;
                /* Cambia el color al pasar el mouse sobre el icono de cierre */
            }
        </style>

        <div id="myModal" class="modal text-center">
            <div class="modal-content">
                <span class="close close-modal">&times;</span>
                <p class="input-description"><strong>Introducir puntos de valor para cada apartado:</strong> (Dejar
                    vacío para puntos de valor por defecto)</p>
                <form id="evaluarForm" action="{{ route('asistencias.evaluar') }}" method="POST">
                    @csrf
                    <input type="number" name="Puntos_Puntuales" placeholder="Valor Asistencias Puntuales">
                    <input type="number" name="Puntos_Atrasos" placeholder="Valor Asistencias Atrasadas">
                    <input type="number" name="Puntos_Justificada" placeholder="Valor Falta Justificada">
                    <input type="number" name="Puntos_Injustificada" placeholder="Valor Falta Injustificada">

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
            btn.onclick = function() {
                modal.style.display = "block";
            }

            // Cuando se presiona en la 'x' del modal, cerrarlo
            span.onclick = function() {
                modal.style.display = "none";
            }

            // Cuando se presiona fuera del modal, cerrarlo
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        </script>

        <button id="ordenar-por-puntos" class="px-3 py-2 bg-green-600 font-bold text-white rounded-lg">Ordenar por
            Puntaje</button>

     

        <select id="filtrar-por-mes">
            <option value="0">Todos los meses</option>
            <option value="1">Enero</option>
            <option value="2">Febrero</option>
            <option value="3">Marzo</option>
            <option value="4">Abril</option>
            <option value="5">Mayo</option>
            <option value="6">Junio</option>
            <option value="7">Julio</option>
            <option value="8">Agosto</option>
            <option value="9">Septiembre</option>
            <option value="10">Octubre</option>
            <option value="11">Noviembre</option>
            <option value="12">Diciembre</option>
        </select>

        <select id="filtrarPorDepartamento">
            <option value="" selected>Mostrar todos</option>
            @foreach ($departamentos as $departamento)
                <option value="{{ $departamento->id }}">{{ $departamento->nombre }}</option>
            @endforeach
        </select>

        <script>
            document.getElementById('filtrarPorDepartamento').addEventListener('change', function() {
                var selectedDepartamentoID = this.value;
                var rows = document.querySelectorAll('.evaluacion-table tbody tr');
                rows.forEach(function(row) {
                    var departamentoID = row.dataset.departamentoId;
                    if (!selectedDepartamentoID || departamentoID === selectedDepartamentoID) {
                        row.style.display = 'table-row';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        </script>


        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var filtroMes = document.getElementById('filtrar-por-mes');
                var ordenAscendente = true; // Estado inicial para orden ascendente
                var rows = Array.from(document.querySelectorAll('.evaluacion-table tbody tr'));

                // Función para ordenar las filas por puntaje
                function ordenarFilasPorPuntos() {
                    rows.sort(function(rowA, rowB) {
                        var puntosA = parseInt(rowA.querySelector('.puntos-column').innerText);
                        var puntosB = parseInt(rowB.querySelector('.puntos-column').innerText);
                        if (ordenAscendente) {
                            return puntosA - puntosB; // Orden ascendente
                        } else {
                            return puntosB - puntosA; // Orden descendente
                        }
                    });

                    var tbody = document.querySelector('.evaluacion-table tbody');
                    tbody.innerHTML = '';
                    rows.forEach(function(row) {
                        tbody.appendChild(row);
                    });
                }

                // Función para actualizar la visibilidad de las filas según el mes seleccionado
                function actualizarFiltroPorMes() {
                    var mesSeleccionado = parseInt(filtroMes.value); // Obtener el mes seleccionado del filtro

                    rows.forEach(function(row) {
                        var mes = parseInt(row.querySelector('.mes-column')
                        .innerText); // Obtener el mes de la fila

                        // Mostrar la fila si coincide con el mes seleccionado o si es "Todos los meses"
                        if (mesSeleccionado === 0 || mes === mesSeleccionado) {
                            row.style.display = ''; // Mostrar la fila
                        } else {
                            row.style.display = 'none'; // Ocultar la fila si no coincide
                        }
                    });
                }

                // Función para manejar el click en el botón de ordenar por puntos
                document.getElementById('ordenar-por-puntos').addEventListener('click', function() {
                    ordenarFilasPorPuntos();
                    ordenAscendente = !ordenAscendente; // Cambiar el estado para la próxima vez
                });

                // Escuchar cambios en el select de filtrar por mes
                filtroMes.addEventListener('change', function() {
                    // Mostrar todas las filas antes de aplicar el nuevo filtro por mes
                    rows.forEach(function(row) {
                        row.style.display = ''; // Mostrar todas las filas
                    });

                    // Actualizar visibilidad de las filas al cambiar el mes seleccionado
                    actualizarFiltroPorMes();
                });

                // Mostrar todas las filas inicialmente (Todos los meses seleccionado por defecto)
                ordenarFilasPorPuntos(); // Activar el ordenamiento por puntaje al cargar la página
                actualizarFiltroPorMes(); // Aplicar el filtro inicialmente
            });
        </script>



    </x-slot>





    <title>Criterios de evaluación del personal</title>

    <table class="min-w-full border-collapse block md:table evaluacion-table">
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
                @if ($calificaciones_Empleado->puntaje !== null)
                    <tr class="bg-white border border-grey-500 md:border-none block md:table-row" data-departamento-id="{{ $calificaciones_Empleado->empleado->ID_Departamento }}">
                        <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span
                                class="inline-block w-1/3 md:hidden font-bold">ID</span>{{ $calificaciones_Empleado->id }}
                        </td>
                        <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span
                                class="inline-block w-1/3 md:hidden font-bold">Nombre</span>{{ $calificaciones_Empleado->empleado->usuario->name }}
                        </td>
                        <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span
                                class="inline-block w-1/3 md:hidden font-bold">Cargo</span>{{ $calificaciones_Empleado->empleado->cargo->nombre }}
                        </td>
                        <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span
                                class="inline-block w-1/3 md:hidden font-bold">Departamento</span>{{ $calificaciones_Empleado->empleado->departamento->nombre }}
                        </td>
                        <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span
                                class="inline-block w-1/3 md:hidden font-bold">Asistencias
                                Esperadas</span>{{ $calificaciones_Empleado->cantAsisTotalesEsperadas }}</td>
                        <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span
                                class="inline-block w-1/3 md:hidden font-bold">Asistencias
                                Puntuales</span>{{ $calificaciones_Empleado->cantAsisPuntuales }}</td>
                        <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span
                                class="inline-block w-1/3 md:hidden font-bold">Asistencias
                                Atrasadas</span>{{ $calificaciones_Empleado->cantAsisAtraso }}</td>
                        <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span
                                class="inline-block w-1/3 md:hidden font-bold">Asistencias
                                Injustificadas</span>{{ $calificaciones_Empleado->cantFaltInjustificada }}</td>
                        <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span
                                class="inline-block w-1/3 md:hidden font-bold">Asistencias
                                Justificada</span>{{ $calificaciones_Empleado->cantFaltaJustificada }}</td>
                        <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell mes-column">
                            <span
                                class="inline-block w-1/3 md:hidden font-bold">Mes</span>{{ $calificaciones_Empleado->mes }}
                        </td>

                        <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span
                                class="inline-block w-1/3 md:hidden font-bold">Año</span>{{ $calificaciones_Empleado->anio }}
                        </td>

                        <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell puntos-column">
                            <span class="inline-block w-1/3 md:hidden font-bold">Puntaje</span>
                            {{ $calificaciones_Empleado->puntaje }}
                        </td>


                        <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                            <div class="flex flex-wrap">
                            <span class="inline-block w-1/3 md:hidden font-bold">Acciones</span>
                            {{-- @can('Ver Evaluacion')
                            <a href="{{ route('asistencias.editarEvaluacion', $calificaciones_Empleado->id) }}"
                                class = "bg-green-400 px-2 py-2 rounded-lg" title="Editar">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </a>
                            @endcan --}}
                            @can('Ver Evaluacion')
                            <div>
                                <form id="formEliminar_{{ $calificaciones_Empleado->id }}" 
                                    action="{{ route('asistencias.eliminarEvaluacion', $calificaciones_Empleado->id) }}" method="POST">
                                    @csrf
                                    <button type="button" class="bg-red-500 px-2 py-2 rounded-lg" title="Eliminar"
                                        onclick="confirmarEliminacion('{{ $calificaciones_Empleado->id }}')">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                            @endcan
                        </div>
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>

</x-app-layout>
