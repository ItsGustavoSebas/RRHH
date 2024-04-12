<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-welcome />
            </div>
        </div>


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

        





    </div>
</x-app-layout>
