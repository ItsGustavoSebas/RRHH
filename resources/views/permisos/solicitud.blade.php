<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Solicitar Permiso') }}
        </h2>
    </x-slot>

    <div class="container mx-auto">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                    <form method="POST" action="{{ route('permisos.enviar-solicitud') }}" class="space-y-4">
                        @csrf

                        <div>
                            <label for="motivo" class="block text-sm font-medium text-gray-700">Motivo del Permiso</label>
                            <input id="motivo" type="text" class="form-input mt-1 block w-full" name="motivo" required autofocus>
                        </div>

                        <div>
                            <label for="fecha_inicio" class="block text-sm font-medium text-gray-700">Fecha de Inicio</label>
                            <input id="fecha_inicio" type="date" class="form-input mt-1 block w-full" name="fecha_inicio" required>
                        </div>

                        <div>
                            <label for="fecha_fin" class="block text-sm font-medium text-gray-700">Fecha de Fin</label>
                            <input id="fecha_fin" type="date" class="form-input mt-1 block w-full" name="fecha_fin" required>
                        </div>

                        <div>
                            <button type="submit" class="inline-block px-4 py-2 bg-indigo-600 text-white font-semibold rounded-lg">Enviar Solicitud</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
