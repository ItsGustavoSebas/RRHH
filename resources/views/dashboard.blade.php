<x-app-layout>
    @if (Auth::user()->postulante)
        <div class="bg-blue-300 flex justify-between mt-[55px]">
            <div class=" max-w-7xl px-4 py-6 bg-blue-300 sm:px-6 lg:px-8 hidden lg:block md:block">
                @if (Auth::user()->postulante->ruta_imagen_e)
                    <img class="flex-1 w-48 h-48 rounded-full shadow-lg"
                        src="{{ Auth::user()->postulante->ruta_imagen_e }}" alt="{{ Auth::user()->name }}" />
                @else
                    <img class="flex-1 w-48 h-48 rounded-full shadow-lg" src="{{ Auth::user()->profile_photo_url }}"
                        alt="{{ Auth::user()->name }}" />
                @endif
            </div>
            <div class="bg-blue-300  max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <h1 class=" text-3xl font-sans tracking-tight text-gray-900">
                    {{ Auth::user()->name }}
                </h1>
                @if (Auth::user()->postulante->puesto_disponible)
                    <p class="ml-10">Postulante para {{ Auth::user()->postulante->puesto_disponible->nombre }}</p>
                @endif
            </div>

            <div class="bg-blue-300 mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">

                <div class="flex justify-between">

                    <!-- Content -->
                    <div class="flex-1">
                        <!-- Rest of content -->
                    </div>

                    <!-- Buttons -->
                    <div class="flex space-x-4 lg:block md:block">
                        <button class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded-md">Request a
                            Change</button>
                        <button class="bg-gray-500 hover:bg-gray-600 text-white px-2 py-1 rounded-md">Settings</button>
                    </div>

                </div>

            </div>

        </div>
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
                                <li class=" mr-1">
                                    <a class="rounded-sm bg-white inline-block border-l border-t border-r rounded-t py-2 px-4 text-blue-700 font-semibold shadow-md"
                                        href="#">Información</a>
                                </li>
                                <li class="mr-1">
                                    <a class="rounded-sm bg-white inline-block border-l border-t border-r rounded-t py-2 px-4 text-blue-500 hover:text-blue-800 font-semibold"
                                        href="#">Educaciones</a>
                                </li>
                                <li class="mr-1">
                                    <a class="rounded-sm bg-white inline-block border-l border-t border-r rounded-t py-2 px-4 text-blue-500 hover:text-blue-800 font-semibold"
                                        href="#">Reconocimientos</a>
                                </li>
                                <li class="mr-1">
                                    <a class="rounded-sm bg-white inline-block border-l border-t border-r rounded-t py-2 px-4 text-blue-500 hover:text-blue-800 font-semibold"
                                        href="#">Experiencias</a>
                                </li>
                                <li class="mr-1">
                                    <a class="rounded-sm bg-white inline-block border-l border-t border-r rounded-t py-2 px-1 text-blue-500 hover:text-blue-800 font-semibold"
                                        href="#">Referencias</a>
                                </li>

                            </ul>
                        </div>
                        <!-- Contenido -->
                        <div class="bg-white p-3 rounded-sm">
                        </div>
                        <div class="bg-white p-3 rounded-sm">
                            <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8">
                                <span clas="text-green-500">
                                    <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                        </path>
                                    </svg>
                                </span>
                                <span class="tracking-wide px-2">Información Personal</span>
                            </div>
                            <div class="flex flex-col my-2 py-1">
                                <p class="tracking-wide px-2">Fecha de nacimiento:
                                    {{ Auth::user()->postulante->fecha_de_nacimiento }}</p>
                                <p class="tracking-wide px-2">Nacionalidad:
                                    {{ Auth::user()->postulante->nacionalidad }}</p>
                                <p class="tracking-wide px-2">Habilidades: {{ Auth::user()->postulante->habilidades }}
                                </p>
                                <p class="tracking-wide px-2">Fuente de Contratación:
                                    {{ Auth::user()->postulante->fuente_de_contratacion->nombre }}</p>
                                <p class="tracking-wide px-2">Idioma Secundario:
                                    {{ Auth::user()->postulante->idioma->nombre }} -
                                    {{ Auth::user()->postulante->nivel_idioma->categoria }}</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>

    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
                    <a href="{{ route('educaciones.rinicio') }}"
                        class="inline-block px-4 py-2 bg-indigo-600 text-white font-semibold rounded-lg">Gestionar
                        educaciones</a>
                    <a href="{{ route('postulantes.rinicio') }}"
                        class="inline-block px-4 py-2 bg-indigo-600 text-white font-semibold rounded-lg">Gestionar
                        información de postulación</a>
                    <a href="{{ route('reconocimientos.rinicio') }}"
                        class="inline-block px-4 py-2 bg-indigo-600 text-white font-semibold rounded-lg">Gestionar
                        reconocimientos</a>
                    <a href="{{ route('experiencias.rinicio') }}"
                        class="inline-block px-4 py-2 bg-indigo-600 text-white font-semibold rounded-lg">Gestionar
                        experiencias</a>
                    <a href="{{ route('referencias.rinicio') }}"
                        class="inline-block px-4 py-2 bg-indigo-600 text-white font-semibold rounded-lg">Gestionar
                        referencias</a>
                    <a href="{{ route('postulantes.postularse') }}"
                        class="inline-block px-4 py-2 bg-indigo-600 text-white font-semibold rounded-lg">Postularse</a>
                    <a href="{{ route('reportes.inicio') }}"
                        class="inline-block px-4 py-2 bg-indigo-600 text-white font-semibold rounded-lg">Reportes</a>
                </div>
            </div>
        </div>



        {{-- 
        <a class = "px-3 py-2 bg-indigo-600 font-bold text-white rounded-lg"
        href="{{ route('educaciones.rinicio') }}">Gestionar educaciones</a>
      

      

        <a class = "px-3 py-2 bg-indigo-600 font-bold text-white rounded-lg"
        href="{{ route('postulantes.rinicio') }}">Gestionar información de postulación</a>


        
        <a class = "px-3 py-2 bg-indigo-600 font-bold text-white rounded-lg"
        href="{{ route('reconocimientos.rinicio') }}">Gestionar reconocimientos</a>



        <a class = "px-3 py-2 bg-indigo-600 font-bold text-white rounded-lg"
        href="{{ route('experiencias.rinicio') }}">Gestionar experiencias</a>




        <a class = "px-3 py-2 bg-indigo-600 font-bold text-white rounded-lg"
        href="{{ route('referencias.rinicio') }}">Gestionar referencias</a>



        <a class="px-3 py-2 bg-indigo-600 font-bold text-white rounded-lg"
         href="{{ route('postulantes.postularse') }}">Postularse</a>

         <a class="px-3 py-2 bg-indigo-600 font-bold text-white rounded-lg"
         href="{{ route('informacionpersonal.inicio', '4') }}">InformacionPersonal</a>
 --}}







    </div>
</x-app-layout>
