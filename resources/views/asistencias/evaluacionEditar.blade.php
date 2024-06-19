<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Departamento') }}
        </h2>
    </x-slot>

    <title>Editar Evaluacion</title>

    <div class="max-w-3xl mx-auto mt-10 bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <form action="{{ route('asistencias.actualizarEvaluacion', $calificaciones_Empleados->id) }}" method="POST" class="p-6">
            @csrf

            <div class="grid grid-cols-1 gap-4">

                <div>
                    <label class="font-bold text-lg" for="cantAsisTotalesEsperadas">Cantidad Asistencias Totales Esperadas</label>
                    <input id="cantAsisTotalesEsperadas" name="cantAsisTotalesEsperadas" type="number"
                        class="block w-full px-3 py-2 rounded-lg bg-blue-100 mt-1" value="{{ $calificaciones_Empleados->cantAsisTotalesEsperadas }}">
                    @error('cantAsisTotalesEsperadas')
                        <strong class="text-red-500">{{ $message }}</strong>
                    @enderror
                </div>

                <div>
                    <label class="font-bold text-lg" for="cantAsisPuntuales">Cantidad Asistencias Puntuales</label>
                    <input id="cantAsisPuntuales" name="cantAsisPuntuales" type="number"
                        class="block w-full px-3 py-2 rounded-lg bg-blue-100 mt-1" value="{{ $calificaciones_Empleados->cantAsisPuntuales }}">
                    @error('cantAsisPuntuales')
                        <strong class="text-red-500">{{ $message }}</strong>
                    @enderror
                </div>

                <div>
                    <label class="font-bold text-lg" for="cantAsisAtraso">Cantidad Asistencias con Atraso</label>
                    <input id="cantAsisAtraso" name="cantAsisAtraso" type="number"
                        class="block w-full px-3 py-2 rounded-lg bg-blue-100 mt-1" value="{{ $calificaciones_Empleados->cantAsisAtraso }}">
                    @error('cantAsisAtraso')
                        <strong class="text-red-500">{{ $message }}</strong>
                    @enderror
                </div>

                <div>
                    <label class="font-bold text-lg" for="cantFaltInjustificada">Cantidad Faltas Injustificadas</label>
                    <input id="cantFaltInjustificada" name="cantFaltInjustificada" type="number"
                        class="block w-full px-3 py-2 rounded-lg bg-blue-100 mt-1" value="{{ $calificaciones_Empleados->cantFaltInjustificada }}">
                    @error('cantFaltInjustificada')
                        <strong class="text-red-500">{{ $message }}</strong>
                    @enderror
                </div>

                <div>
                    <label class="font-bold text-lg" for="cantFaltaJustificada">Cantidad Faltas Justificadas</label>
                    <input id="cantFaltaJustificada" name="cantFaltaJustificada" type="number"
                        class="block w-full px-3 py-2 rounded-lg bg-blue-100 mt-1" value="{{ $calificaciones_Empleados->cantFaltaJustificada }}">
                    @error('cantFaltaJustificada')
                        <strong class="text-red-500">{{ $message }}</strong>
                    @enderror
                </div>

                <div>
                    <label class="font-bold text-lg" for="mes">Mes</label>
                    <select id="mes" name="mes" class="block w-full px-3 py-2 rounded-lg bg-blue-100 mt-1">
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ $i == $calificaciones_Empleados->mes ? 'selected' : '' }}>
                                {{ \Carbon\Carbon::create()->month($i)->locale('es')->monthName }}
                            </option>
                        @endfor
                    </select>
                    @error('mes')
                        <strong class="text-red-500">{{ $message }}</strong>
                    @enderror
                </div>

                <div>
                    <label class="font-bold text-lg" for="anio">Año</label>
                    <input id="anio" name="anio" type="number" class="block w-full px-3 py-2 rounded-lg bg-blue-100 mt-1"
                        value="{{ $calificaciones_Empleados->anio }}">
                    @error('anio')
                        <strong class="text-red-500">{{ $message }}</strong>
                    @enderror
                </div>

                <div>
                    <label class="font-bold text-lg" for="puntaje">Puntaje</label>
                    <input id="puntaje" name="puntaje" type="number" class="block w-full px-3 py-2 rounded-lg bg-blue-100 mt-1"
                        value="{{ $calificaciones_Empleados->puntaje }}">
                    @error('puntaje')
                        <strong class="text-red-500">{{ $message }}</strong>
                    @enderror
                </div>

                <div class="mt-6 flex justify-center">
                    <button type="submit"
                        class="bg-blue-600 text-white font-bold px-5 py-3 rounded-lg hover:bg-blue-500">
                        <i class="fas fa-save"></i> Guardar
                    </button>
                </div>

            </div>
        </form>
    </div>

</x-app-layout>
