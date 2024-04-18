<x-app-layout>
    <title>Informacion</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Estilo para el modal */
        .button {
            position: relative;
        }

        .modal {
            display: none;
            position: absolute;
            z-index: 9999;
            background-color: #fefefe;
            border: 1px solid #888;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            padding: 20px;
        }

        .modal-content {
            /* Estilos para el contenido del modal */
        }

        .close {
            position: absolute;
            top: 8px;
            right: 8px;
            cursor: pointer;
        }
    </style>
    <div class="flex flex-col items-center justify-center min-h-screen ">
        <!-- dark theme -->
        <div class="container  m-4">
            <div class="max-w-5xl w-full mx-auto grid gap-4 grid-cols-1">
                <!-- profile card -->
                <div class="flex flex-col sticky top-0 z-10">
                    <div class="bg-white border border-gray-800 shadow-lg  rounded-2xl p-4">
                        <div class="flex-none sm:flex">
                            <div class=" relative h-32 w-32   sm:mb-0 mb-3">
                                <!-- Foto --><img
                                    src="https://tailwindcomponents.com/storage/avatars/njkIbPhyZCftc4g9XbMWwVsa7aGVPajYLRXhEeoo.jpg"
                                    alt="aji" class=" w-32 h-32 object-cover rounded-2xl border-2 border-gray-800">
                                {{-- Editar Foto <a href="#"
                                    class="absolute -right-2 bottom-2   -ml-3  text-white p-1 text-xs bg-green-400 hover:bg-green-500 font-medium tracking-wider rounded-full transition ease-in duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                        class="h-4 w-4">
                                        <path
                                            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                        </path>
                                    </svg>
                                </a> --}}
                            </div>
                            <div class="flex-auto sm:ml-5 justify-evenly">
                                <div class="flex items-center justify-between sm:mt-2">
                                    <div class="flex items-center">
                                        <div class="flex flex-col">
                                            <div class="w-full flex-none text-lg text-gray-700 font-bold leading-none">
                                                <!-- Nombre --> {{ $empleado->usuario->name }}
                                            </div>
                                            <div class="flex-auto text-gray-500 my-1">
                                                <!-- Departamento, Cargo --> <span
                                                    class="mr-3 ">{{ $departamento->nombre }}
                                                </span><span
                                                    class="mr-3 border-r border-gray-600  max-h-0"></span><span>{{ $cargo->nombre }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex flex-row items-center">
                                    <div class="flex">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                            class="h-5 w-5 text-yellow-400">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                            </path>
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                            class="h-5 w-5 text-yellow-400">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                            </path>
                                        </svg><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                            fill="currentColor" class="h-5 w-5 text-yellow-400">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                            </path>
                                        </svg><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                            fill="currentColor" class="h-5 w-5 text-yellow-400">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                            </path>
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" class="h-5 w-5 text-yellow-400">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex pt-2  text-sm text-gray-400">
                                    <div class="flex-1 inline-flex items-center">
                                        {{-- <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path
                                                d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z">
                                            </path>
                                        </svg>
                                        <p class="">1.2k Followers</p> --}}
                                    </div>
                                    <div class="flex-1 inline-flex items-center">
                                        {{-- <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <p class="">14 Components</p> --}}
                                    </div>
                                    <a href="https://www.behance.net/ajeeshmon" target="_blank"
                                        class="flex-no-shrink bg-green-400 hover:bg-green-500 px-5 ml-4 py-2 text-xs shadow-sm hover:shadow-lg font-medium tracking-wider border-2 border-green-300 hover:border-green-500 text-white rounded-full transition ease-in duration-300">CHAT</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!---stats-->
                <!---stats1 -->
                <div class="grid gap-4 grid-cols-1 md:grid-cols-2">
                    <!--confirm modal-->
                    <div class="flex flex-col relative bg-white border border-gray-800   rounded-2xl">
                        <div class="text-xl font-bold py-4 px-4 mb-5 text-gray-700">
                            <h2>General</h3>
                        </div>
                        <div class="px-11 ml-6">
                            <div
                                style="display: grid; grid-template-columns: 1fr 1fr; grid-template-rows: repeat(3, 1fr); gap: 10px;">
                                <!-- Fila 1 -->
                                <!-- Columna 1 -->
                                <!-- Modal -->
                                <div id="ModalD" class="modal">
                                    <span class="close" onclick="cerrarModalD()">&times;</span>
                                    <h2>Seleccionar Departamento</h2>
                                    <form id="guardarDepartamentoForm"
                                        action="{{ route('informacionpersonal.actualizar.departamento', $empleado->usuario->id) }}"
                                        method="POST">
                                        @csrf
                                        <select name="ID_Departamento" id="ID_Departamento"
                                            class="mb-4 w-full p-2 border rounded-md">
                                            @foreach ($departamentos as $dep)
                                                <option value="{{ $dep->id }}">{{ $dep->nombre }}</option>
                                            @endforeach
                                        </select>
                                        <button type="submit"
                                            class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">Guardar</button>
                                    </form>
                                </div>
                                <!-- Modal -->
                                <div class="flex items-center mb-5">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                                        <path
                                            d="M20 13.01h-7V10h1c1.103 0 2-.897 2-2V4c0-1.103-.897-2-2-2h-4c-1.103 0-2 .897-2 2v4c0 1.103.897 2 2 2h1v3.01H4V18H3v4h4v-4H6v-2.99h5V18h-1v4h4v-4h-1v-2.99h5V18h-1v4h4v-4h-1v-4.99zM10 8V4h4l.002 4H10z">
                                        </path>
                                    </svg>
                                    <p class="ml-2">{{ $departamento->nombre }}</p>
                                    <button
                                        class="ml-2 text-white p-1 text-xs bg-green-400 hover:bg-green-500 font-medium tracking-wider rounded-full transition ease-in duration-300"
                                        onclick="mostrarModalD()">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                            class="h-4 w-4">
                                            <path
                                                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                                <!-- Columna 2 -->
                                <!-- Modal -->
                                <div id="ModalC" class="modal">
                                    <span class="close" onclick="cerrarModalC()">&times;</span>
                                    <h2>Seleccionar Cargo</h2>
                                    <form id="guardarCargoForm"
                                        action="{{ route('informacionpersonal.actualizar.cargo', $empleado->usuario->id) }}"
                                        method="POST">
                                        @csrf
                                        <select name="ID_Cargo" id="ID_Cargo"
                                            class="mb-4 w-full p-2 border rounded-md">
                                            @foreach ($cargos as $cag)
                                                <option value="{{ $cag->id }}">{{ $cag->nombre }}</option>
                                            @endforeach
                                        </select>
                                        <button type="submit"
                                            class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">Guardar</button>
                                    </form>
                                </div>
                                <!-- Modal -->
                                <div class="flex items-center mb-5">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                                        <path
                                            d="M16.604 11.048a5.67 5.67 0 0 0 .751-3.44c-.179-1.784-1.175-3.361-2.803-4.44l-1.105 1.666c1.119.742 1.8 1.799 1.918 2.974a3.693 3.693 0 0 1-1.072 2.986l-1.192 1.192 1.618.475C18.951 13.701 19 17.957 19 18h2c0-1.789-.956-5.285-4.396-6.952z">
                                        </path>
                                        <path
                                            d="M9.5 12c2.206 0 4-1.794 4-4s-1.794-4-4-4-4 1.794-4 4 1.794 4 4 4zm0-6c1.103 0 2 .897 2 2s-.897 2-2 2-2-.897-2-2 .897-2 2-2zm1.5 7H8c-3.309 0-6 2.691-6 6v1h2v-1c0-2.206 1.794-4 4-4h3c2.206 0 4 1.794 4 4v1h2v-1c0-3.309-2.691-6-6-6z">
                                        </path>
                                    </svg>
                                    <p class="ml-2">{{ $cargo->nombre }}</p>
                                    <button
                                        class="ml-2 text-white p-1 text-xs bg-green-400 hover:bg-green-500 font-medium tracking-wider rounded-full transition ease-in duration-300"
                                        onclick="mostrarModalC()">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                            fill="currentColor" class="h-4 w-4">
                                            <path
                                                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                            </path>
                                        </svg>
                                    </button>
                                </div>

                                <!-- Fila 2 -->
                                <!-- Columna 1 -->
                                <!-- Modal -->
                                <div id="ModalT" class="modal">
                                    <span class="close" onclick="cerrarModalT()">&times;</span>
                                    <h2>Escriba el Teléfono</h2>
                                    <form id="guardarTelefonoForm"
                                        action="{{ route('informacionpersonal.actualizar.telefono', $empleado->usuario->id) }}"
                                        method="POST">
                                        @csrf
                                        <input type="tel" name="telefono" id="telefono"
                                            class="mb-4 w-full p-2 border rounded-md" placeholder="Teléfono"
                                            value="{{ old('telefono') }}">
                                        <button type="submit"
                                            class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">Guardar</button>
                                    </form>
                                </div>
                                <!-- Modal -->
                                <div class="flex items-center mb-5">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                                        <path
                                            d="m20.487 17.14-4.065-3.696a1.001 1.001 0 0 0-1.391.043l-2.393 2.461c-.576-.11-1.734-.471-2.926-1.66-1.192-1.193-1.553-2.354-1.66-2.926l2.459-2.394a1 1 0 0 0 .043-1.391L6.859 3.513a1 1 0 0 0-1.391-.087l-2.17 1.861a1 1 0 0 0-.29.649c-.015.25-.301 6.172 4.291 10.766C11.305 20.707 16.323 21 17.705 21c.202 0 .326-.006.359-.008a.992.992 0 0 0 .648-.291l1.86-2.171a.997.997 0 0 0-.085-1.39z">
                                        </path>
                                    </svg>
                                    <p class="ml-2">{{ $empleado->usuario->telefono }}</p>
                                    <button
                                        class="ml-2 text-white p-1 text-xs bg-green-400 hover:bg-green-500 font-medium tracking-wider rounded-full transition ease-in duration-300"
                                        onclick="mostrarModalT()">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                            fill="currentColor" class="h-4 w-4">
                                            <path
                                                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                                <!-- Columna 2 -->
                                <div class="flex items-center mb-5">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                                        <path
                                            d="M7 11h2v2H7zm0 4h2v2H7zm4-4h2v2h-2zm0 4h2v2h-2zm4-4h2v2h-2zm0 4h2v2h-2z">
                                        </path>
                                        <path
                                            d="M5 22h14c1.103 0 2-.897 2-2V6c0-1.103-.897-2-2-2h-2V2h-2v2H9V2H7v2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2zM19 8l.001 12H5V8h14z">
                                        </path>
                                    </svg>
                                    <p class="ml-2">Horario</p>
                                    <button
                                        class="ml-2 text-white p-1 text-xs bg-green-400 hover:bg-green-500 font-medium tracking-wider rounded-full transition ease-in duration-300"
                                        onclick="mostrarModal()">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                            fill="currentColor" class="h-4 w-4">
                                            <path
                                                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                            </path>
                                        </svg>
                                    </button>
                                </div>

                                <!-- Fila 3 -->
                                <!-- Columna 1 -->
                                <div class="flex items-center">

                                </div>
                                <!-- Columna 2 -->
                                <div class="flex items-center">

                                </div>
                            </div>
                        </div>
                    </div>

                    <!--Basic Information-->
                    <div class="flex flex-col relative bg-white border border-gray-800 text-black  rounded-2xl">

                        <div class="text-xl font-bold py-4 px-4 mb-5 ">
                            <h2>Información Básica</h3>
                        </div>
                        <div class="px-4 ml-4">
                            <div
                                style="display: grid; grid-template-columns: 1fr 1fr; grid-template-rows: repeat(6, 1fr); gap: 10px;">
                                <div class="flex items-center">
                                    <p class="text-gray-600">Nombre</p>
                                </div>
                                <div class="flex items-center">
                                    <p class="">{{ $empleado->usuario->name }}</p>
                                </div>
                                <div class="flex items-center">
                                    <p class="text-gray-600">Email</p>
                                </div>
                                <div class="flex items-center">
                                    <p class="">{{ $empleado->usuario->email }}</p>
                                </div>
                                <div class="flex items-center">
                                    <p class="text-gray-600">C.I.</p>
                                </div>
                                <div class="flex items-center">
                                    <p class="">{{ $empleado->usuario->name }}</p>
                                </div>
                                <div class="flex items-center">
                                    <p class="text-gray-600">Dirección</p>
                                </div>
                                <div class="flex items-center">
                                    <p class="">{{ $empleado->usuario->direccion }}</p>
                                </div>
                                <div class="flex items-center">
                                    <p class="text-gray-600">Teléfono</p>
                                </div>
                                <div class="flex items-center">
                                    <p class="">{{ $empleado->usuario->telefono }}</p>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col relative bg-white border border-gray-800 text-black  rounded-2xl">

                        <div class="text-xl font-bold py-4 px-4 mb-5">
                            <h2>Información del Trabajo</h3>
                        </div>
                        <div class="px-4 ml-4">
                            <div
                                style="display: grid; grid-template-columns: 1fr 1fr; grid-template-rows: repeat(6, 1fr); gap: 10px;">
                                <div class="flex items-center">
                                    <p class="text-gray-600">Departamento</p>
                                </div>
                                <div class="flex items-center">
                                    <p class="">{{ $departamento->nombre }}</p>
                                </div>
                                <div class="flex items-center">
                                    <p class="text-gray-600">Cargo</p>
                                </div>
                                <div class="flex items-center">
                                    <p class="">{{ $cargo->nombre }}</p>
                                </div>
                                <div class="flex items-center">
                                    <p class="text-gray-600">Fecha Ingreso</p>
                                </div>
                                <div class="flex items-center">
                                    <p class="">Fecha Ingreso</p>
                                </div>
                                <div class="flex items-center">
                                    <p class="text-gray-600">Experencia actual</p>
                                </div>
                                <div class="flex items-center">
                                    <p class="">Experencia actual</p>
                                </div>
                                <div class="flex items-center">
                                    <p class="text-gray-600">Experiencia Total</p>
                                </div>
                                <div class="flex items-center">
                                    <p class="">Experiencia Total</p>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col relative bg-white border border-gray-800 text-black  rounded-2xl">

                        <div class="text-xl font-bold py-4 px-4 mb-5">
                            <h2>Información Personal</h3>
                        </div>
                        <div class="px-4 ml-4">
                            <div
                                style="display: grid; grid-template-columns: 1fr 1fr; grid-template-rows: repeat(6, 1fr); gap: 10px;">
                                <div class="flex items-center">
                                    <p class="text-gray-600">Fecha de Nacimiento</p>
                                </div>
                                <div class="flex items-center">
                                    <p class="">{{ $empleado->fechanac }}</p>
                                </div>
                                <div class="flex items-center">
                                    <p class="text-gray-600">Edad</p>
                                </div>
                                <div class="flex items-center">
                                    <p class="">{{ $empleado->edad }}</p>
                                </div>
                                <div class="flex items-center">
                                    <p class="text-gray-600">Género</p>
                                </div>
                                <div class="flex items-center">
                                    <p class="">{{ $empleado->genero }}</p>
                                </div>
                                <div class="flex items-center">
                                    <p class="text-gray-600">Estado Civil</p>
                                </div>
                                <div class="flex items-center">
                                    <p class="">{{ $empleado->estadocivil }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid gap-4 grid-cols-1 md:grid-cols-2">

                    <!--confirm modal-->
                    <div class="flex flex-col relative bg-white border border-gray-800  text-black rounded-2xl">

                        <div class="text-xl font-bold py-4 px-4 mb-5">
                            <h2>Campos del sistema</h3>
                        </div>
                        <div class="px-4 ml-4">
                            <div
                                style="display: grid; grid-template-columns: 1fr 1fr; grid-template-rows: repeat(6, 1fr); gap: 10px;">
                                <div class="flex items-center">
                                    <p class="text-gray-600">Añadido por</p>
                                </div>
                                <div class="flex items-center">
                                    <p class="">Añadido por</p>
                                </div>
                                <div class="flex items-center">
                                    <p class="text-gray-600">Fecha añadido</p>
                                </div>
                                <div class="flex items-center">
                                    <p class="">{{ $empleado->created_at }}</p>
                                </div>
                                <div class="flex items-center">
                                    <p class="text-gray-600">Modificado por</p>
                                </div>
                                <div class="flex items-center">
                                    <p class="">Modificado por</p>
                                </div>
                                <div class="flex items-center">
                                    <p class="text-gray-600">Fecha modificado</p>
                                </div>
                                <div class="flex items-center">
                                    <p class="">{{ $empleado->updated_at }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--elements-->
                    <div class="flex flex-col space-y-4">
                        <!-- elements 1 -->
                        <div
                            class="flex flex-col p- bg-white border-gray-800  text-black shadow-md hover:shodow-lg rounded-2xl">
                            <!-- cursor-pointer transition ease-in duration-500  transform hover:scale-105 -->
                            <div class="text-xl font-bold py-4 px-4 mb-5 ">
                                <div class="inline-flex ">
                                    <h2>Información de Separación</h3>
                                </div>
                            </div>
                            <div class="px-4 ml-4">
                                <div
                                    style="display: grid; grid-template-columns: 1fr 1fr; grid-template-rows: repeat(2, 1fr); gap: 10px;">
                                    <div class="flex items-center">
                                        <p class="text-gray-600">Fecha de Salida</p>
                                    </div>
                                    <div class="flex items-center">
                                        <p class="">Fecha de Salida</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--elements 2-->
                        <div
                            class="flex flex-col p- bg-white border-gray-800 text-black shadow-md hover:shodow-lg rounded-2xl ">
                            <div class="text-xl font-bold py-4 px-4 mb-5 ">
                                <div class="inline-flex ">
                                    <h2>Horario</h3>
                                </div>
                            </div>
                            <div class="px-4 ml-4">
                                <div
                                    style="display: grid; grid-template-columns: 1fr 1fr; grid-template-rows: repeat(2, 1fr); gap: 10px;">
                                    <div class="flex items-center">
                                        <p class="text-gray-600">Horario</p>
                                    </div>
                                    <div class="flex items-center">
                                        <p class="">Horario</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col relative bg-white border border-gray-800 text-black  rounded-2xl pb-6">

                    <div class="text-xl font-bold py-4 px-4 mb-5">
                        <h2>Experiencias Laborales</h3>
                    </div>
                    <div class="px-4 ml-4">
                        <table class="min-w-full border-collapse block md:table">
                            <thead class="block md:table-header-group">
                                <tr
                                    class="border border-grey-500 md:border-none block md:table-row absolute -top-full md:top-auto -left-full md:left-auto  md:relative ">
                                    <th
                                        class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                                        ID</th>
                                    <th
                                        class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                                        Cargo</th>
                                    <th
                                        class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                                        Descripción</th>
                                    <th
                                        class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                                        Años</th>
                                    <th
                                        class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">
                                        Lugar</th>
                                </tr>

                            </thead>
                            <tbody class="block md:table-row-group">

                                {{-- @if (!is_null($experiencias))
                                    @foreach ($experiencias as $experiencia) --}}
                                        <tr class="bg-white border border-grey-500 md:border-none block md:table-row">
                                            <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                                                <span
                                                    class="inline-block w-1/3 md:hidden font-bold">ID</span>1
                                            </td>
                                            <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                                                <span
                                                    class="inline-block w-1/3 md:hidden font-bold">Cargo</span>Cajero
                                            </td>
                                            <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                                                <span
                                                    class="inline-block w-1/3 md:hidden font-bold">Descripción</span>Experiencia como Cajero en un Banco
                                            </td>
                                            <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                                                <span
                                                    class="inline-block w-1/3 md:hidden font-bold">Años</span>2
                                            </td>
                                            <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                                                <span
                                                    class="inline-block w-1/3 md:hidden font-bold">Lugar</span>Banco Union
                                            </td>
                                        </tr>
                                    {{-- @endforeach
                                @else
                                @endif --}}

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="flex flex-col relative bg-white border border-gray-800 text-black  rounded-2xl pb-6">

                    <div class="text-xl font-bold py-4 px-4 mb-5">
                        <h2>Detalle De Educaciones</h3>
                    </div>
                    <div class="px-4 ml-4">
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

                                {{-- @if (!is_null($educaciones))
                                    @foreach ($educaciones as $educacion) --}}
                                <tr class="bg-white border border-grey-500 md:border-none block md:table-row">
                                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                                        <span class="inline-block w-1/3 md:hidden font-bold">ID</span>1
                                    </td>
                                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                                        <span class="inline-block w-1/3 md:hidden font-bold">Nombre del
                                            colegio</span>Colegio Aleman
                                    </td>
                                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                                        <span class="inline-block w-1/3 md:hidden font-bold">Grado
                                            Diploma</span>6to de Secundaria
                                    </td>
                                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                                        <span class="inline-block w-1/3 md:hidden font-bold">Campo de
                                            estudio</span>Escolar
                                    </td>
                                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                                        <span class="inline-block w-1/3 md:hidden font-bold">Fecha de
                                            finalización</span>30/11/2008
                                    </td>
                                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                                        <span class="inline-block w-1/3 md:hidden font-bold">Notas
                                            adicionales</span>Graduado con honores
                                    </td>
                                </tr>
                                {{-- @endforeach
                                @else
                                @endif --}}

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- </div> --}}
    <script>
        // Función para mostrar el modal
        function mostrarModalD() {
            var modal = document.getElementById('ModalD');
            modal.style.display = 'block';
        }


        function mostrarModalC() {
            var modal = document.getElementById('ModalC');
            modal.style.display = 'block';
        }

        function mostrarModalT() {
            var modal = document.getElementById('ModalT');
            modal.style.display = 'block';
        }

        // Función para cerrar el modal
        function cerrarModalD() {
            var modal = document.getElementById('ModalD');
            modal.style.display = 'none';
        }

        function cerrarModalC() {
            var modal = document.getElementById('ModalC');
            modal.style.display = 'none';
        }

        function cerrarModalT() {
            var modal = document.getElementById('ModalT');
            modal.style.display = 'none';
        }

        // Función para enviar el formulario y guardar el elemento seleccionado
        function guardarDepartamento() {
            document.getElementById('guardarDepartamentoForm').submit();
        }

        function guardarCargo() {
            document.getElementById('guardarCargoForm').submit();
        }

        function guardarTelefono() {
            document.getElementById('guardarTelefonoForm').submit();
        }
    </script>


</x-app-layout>
