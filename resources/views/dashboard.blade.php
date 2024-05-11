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

                    <div class="flex-1">
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
        
        <x-tabla-informacion :opcional="$opcional" />
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
