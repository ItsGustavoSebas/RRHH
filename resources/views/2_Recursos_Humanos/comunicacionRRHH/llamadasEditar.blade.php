<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Llamada de Atención') }}
        </h2>
    </x-slot>

    <title>Editar Llamada de Atención</title>

    <div class="max-w-4xl mx-auto mt-10 bg-white shadow-xl sm:rounded-lg p-6">
        <h1 class="text-center font-bold text-3xl mb-10">Editar Llamada de Atención</h1>

        <form action="{{ route('memorandumLlamada.actualizar', $llamadas->id) }}" method="POST">
            @csrf
            <div class="grid lg:grid-cols-1 grid-cols-1 gap-4 p-5">
                <div class="col-span-1">
                    <label class="font-bold text-lg" for="motivo">Motivo</label>
                    <input id="motivo" name="motivo" type="text" class="px-3 py-2 w-full rounded-xl bg-blue-100"
                        value="{{ $llamadas->motivo }}">
                    @error('motivo')
                        <strong class="text-red-500">Debes ingresar tu motivo</strong>
                    @enderror
                </div>

                <div class="col-span-1">
                    <label class="font-bold text-lg" for="gravedad">Gravedad de la llamada de atención</label>
                    <div class="flex -mx-3">
                        <div class="w-full px-3 mb-5">
                            <div class="flex">
                                <div
                                    class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                                    <i class="fa-solid fa-filter"></i>
                                </div>
                                <select name="gravedad" id="gravedad"
                                    class="w-full -ml-10 pl-10 pr-3 py-2 rounded-2xl border-2 border-gray-200 outline-none focus:border-indigo-500">
                                    <option value="">Selecciona una gravedad de la llamada de atención</option>
                                    <option value="Neutral" {{ $llamadas->gravedad == 'Neutral' ? 'selected' : '' }}>Neutral
                                    </option>
                                    <option value="Baja" {{ $llamadas->gravedad == 'Baja' ? 'selected' : '' }}>Baja
                                    </option>
                                    <option value="Grave" {{ $llamadas->gravedad == 'Grave' ? 'selected' : '' }}>Grave
                                    </option>
                                </select>
                            </div>
                            @error('gravedad')
                                <strong class="text-red-500">Debes ingresar la gravedad de la llamada de atención</strong>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center p-5">
                <button type="submit" class="bg-blue-600 text-white font-bold px-5 py-3 rounded-lg">
                    <i class="fa-solid fa-floppy-disk"></i> Guardar
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
