    <div>
        <div class=" max-w-7xl py-0 ">
            <div class="md:flex no-wrap md:-mx-2  ">
                <!-- Left Side -->

                <div class=" w-full md:w-3/12 ">

                    <div class=" p-3 ">

                        <ul
                            class="text-sm font-semibold text-gray-500 hover:text-gray-700 py-2 px-3 mt-3 divide-y rounded bg-white ">
                            <li class="items-center py-3">
                                <span>CI: {{ Auth::user()->ci }}</span><br />
                                <span class="ml-auto">Telefono: {{ Auth::user()->telefono }}</span>

                            </li>
                            <li class="items-center py-3">
                                <h1>Fecha de Creación</h1>
                                <span>{{ Auth::user()->created_at->isoFormat('LL') }}</span><br />
                                <span class="ml-auto">{{ Auth::user()->created_at->diffForHumans() }}</span>
                            </li>

                            <li class=" items-center py-3">
                                <span>Dirección:</span><br />
                                <span class="ml-auto">{{ Auth::user()->direccion }}</span><br />
                                <span class="ml-auto">Correo:</span><br />
                                <span class="ml-auto">{{ Auth::user()->email }}</span>


                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Right Side -->
                <div class="w-full mx-2   md:block lg:block md:mt-6 sm:mt-0">
                    <!-- Profile tab -->
                    <!-- About Section -->
                    <div class="hidden md:block lg:block">
                        <ul class="flex bg-white ">
                            @if (!$opcional || $opcional == null)
                                <li class="mr-1" id="informacion1">
                                    <a class="rounded-sm bg-white inline-block border-l border-t border-r rounded-t py-2 px-4 text-blue-700 font-semibold shadow-md"
                                        href="#" onclick="cargarContenido('informacion')">Información</a>
                                </li>
                            @else
                                <li class="mr-1" id="informacion2">
                                    <a class="rounded-sm bg-white inline-block border-l border-t border-r rounded-t py-2 px-4 text-blue-500 hover:text-blue-800 font-semibold"
                                        href="#" onclick="cargarContenido('informacion')">Información</a>
                                </li>
                            @endif
                            @if ($opcional == 'educaciones')
                                <li class=" mr-1" id="educaciones1">
                                    <a class="rounded-sm bg-white inline-block border-l border-t border-r rounded-t py-2 px-4 text-blue-700 font-semibold shadow-md"
                                        href="#" onclick="cargarContenido('educaciones')">Educaciones</a>
                                </li>
                            @else
                                <li class="mr-1" id="educaciones2">
                                    <a class="rounded-sm bg-white inline-block border-l border-t border-r rounded-t py-2 px-4 text-blue-500 hover:text-blue-800 font-semibold"
                                        href="#" onclick="cargarContenido('educaciones')">Educaciones</a>
                                </li>
                            @endif
                            @if ($opcional == 'reconocimientos')
                                <li class=" mr-1" id="reconocimientos1">
                                    <a class="rounded-sm bg-white inline-block border-l border-t border-r rounded-t py-2 px-4 text-blue-700 font-semibold shadow-md"
                                        href="#" onclick="cargarContenido('reconocimientos')">Reconocimientos</a>
                                </li>
                            @else
                                <li class="mr-1" id="reconocimientos2">
                                    <a class="rounded-sm bg-white inline-block border-l border-t border-r rounded-t py-2 px-4 text-blue-500 hover:text-blue-800 font-semibold"
                                        href="#" onclick="cargarContenido('reconocimientos')">Reconocimientos</a>
                                </li>
                            @endif
                            @if ($opcional == 'experiencias')
                                <li class=" mr-1" id="experiencias1">
                                    <a class="rounded-sm bg-white inline-block border-l border-t border-r rounded-t py-2 px-4 text-blue-700 font-semibold shadow-md"
                                        href="#" onclick="cargarContenido('experiencias')">Experiencias</a>
                                </li>
                            @else
                                <li class="mr-1" id="experiencias2">
                                    <a class="rounded-sm bg-white inline-block border-l border-t border-r rounded-t py-2 px-4 text-blue-500 hover:text-blue-800 font-semibold"
                                        href="#" onclick="cargarContenido('experiencias')">Experiencias</a>
                                </li>
                            @endif
                            @if ($opcional == 'referencias')
                                <li class=" mr-1" id="referencias1">
                                    <a class="rounded-sm bg-white inline-block border-l border-t border-r rounded-t py-2 px-4 text-blue-700 font-semibold shadow-md"
                                        href="#" onclick="cargarContenido('referencias')">Referencias</a>
                                </li>
                            @else
                                <li class="mr-1" id="referencias2">
                                    <a class="rounded-sm bg-white inline-block border-l border-t border-r rounded-t py-2 px-4 text-blue-500 hover:text-blue-800 font-semibold"
                                        href="#" onclick="cargarContenido('referencias')">Referencias</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                    <!-- Contenido -->
                    <div id="contenido">
                        <x-tabla-informacion2 :opcional="$opcional" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function cargarContenido(info) {
            let contenido = document.getElementById('contenido');
            let tablaHTML = '';
    
            if (info === 'informacion') {
                tablaHTML = `<x-tabla-informacion2 :opcional="null" />`;
                
            }
    
            if (info === 'educaciones') {
                tablaHTML = `<x-tabla-informacion2 :opcional="'educaciones'" />`;
            }
    
            if (info === 'reconocimientos') {
                tablaHTML = `<x-tabla-informacion2 :opcional="'reconocimientos'" />`;
            }
    
            if (info === 'experiencias') {
                tablaHTML = `<x-tabla-informacion2 :opcional="'experiencias'" />`;
            }
    
            if (info === 'referencias') {
                tablaHTML = `<x-tabla-informacion2 :opcional="'referencias'" />`;
            }
    
            contenido.innerHTML = tablaHTML;
        }
    </script>
    
