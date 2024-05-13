<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
                    <a href="{{ route('educaciones.rinicio') }}" class="inline-block px-4 py-2 bg-indigo-600 text-white font-semibold rounded-lg">Gestionar educaciones</a>
                    <a href="{{ route('postulantes.rinicio') }}" class="inline-block px-4 py-2 bg-indigo-600 text-white font-semibold rounded-lg">Gestionar información de postulación</a>
                    <a href="{{ route('reconocimientos.rinicio') }}" class="inline-block px-4 py-2 bg-indigo-600 text-white font-semibold rounded-lg">Gestionar reconocimientos</a>
                    <a href="{{ route('experiencias.rinicio') }}" class="inline-block px-4 py-2 bg-indigo-600 text-white font-semibold rounded-lg">Gestionar experiencias</a>
                    <a href="{{ route('referencias.rinicio') }}" class="inline-block px-4 py-2 bg-indigo-600 text-white font-semibold rounded-lg">Gestionar referencias</a>
                    <a href="{{ route('postulantes.postularse') }}" class="inline-block px-4 py-2 bg-indigo-600 text-white font-semibold rounded-lg">Postularse</a>
                    <a href="{{ route('reportes.inicio') }}" class="inline-block px-4 py-2 bg-indigo-600 text-white font-semibold rounded-lg">Reportes</a>
                    <a href="{{ route('permisos.historial') }}" class="inline-block px-4 py-2 bg-indigo-600 text-white font-semibold rounded-lg">Gestionar permisos de personal</a>
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
