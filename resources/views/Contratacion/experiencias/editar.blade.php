<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar reconocimiento') }}
        </h2>
    </x-slot>

    <title>Editar reconocimiento</title>

    <form action="{{ route('experiencias.actualizar', $experiencias->id) }}" method="POST">
        @csrf
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg m-5">

            <div class= "text-center font-sans text-black font-bold text-3xl antialiased  mt-10">
                Edite su experiencia laboral
            </div>

            <div class="grid lg:grid-cols-1 grid-cols-1 gap-4 p-5">
                <div class="col-span-1">
                    <label class="font-bold text-lg" for="cargo">Cargo que tuvo</label>
                    <input id="cargo" name="cargo" type="text" class="px-3 py-2 w-full rounded-xl bg-blue-100" placeholder="Ingresa el cargo" value="{{ $experiencias->cargo }}">
                    @error('cargo')
                        <strong class="text-red-500">Debes ingresar el cargo que tuvo</strong>
                    @enderror
                </div>
                <br>
                            
                <div class="col-span-1">
                    <label class="font-bold text-lg" for="descripcion">Descripción del cargo</label>
                    <input id="descripcion" name="descripcion" type="text" class="px-3 py-2 w-full rounded-xl bg-blue-100" placeholder="Ingresa la descripción del cargo" value="{{ $experiencias->descripcion }}">
                    @error('descripcion')
                        <strong class="text-red-500">Debes ingresar la descripción del cargo</strong>
                    @enderror
                </div>

                <div class="col-span-1">
                    <label class="font-bold text-lg" for="años">Años del cargo en el que estuvo</label>
                    <input id="años" name="años" type="text" class="px-3 py-2 w-full rounded-xl bg-blue-100" placeholder="Ingresa la cantidad de años del cargo en el que estuvo" value="{{ $experiencias->años }}">
                    @error('años')
                        <strong class="text-red-500">Debes ingresar la cantidad de años del cargo en el que estuvo</strong>
                    @enderror
                </div>


                <div class="col-span-1">
                    <label class="font-bold text-lg" for="lugar">Lugar donde trabajo</label>
                    <input id="lugar" name="lugar" type="text" class="px-3 py-2 w-full rounded-xl bg-blue-100" placeholder="Ingrese el lugar donde trabajo" value="{{ $experiencias->lugar }}">
                    @error('lugar')
                        <strong class="text-red-500">Debes ingresar el lugar donde trabajo</strong>
                    @enderror
                </div>


                
                            
                

                <br>
                            
                <div class="p-5 text-center">
                    <button type="submit" id="registrar" class="bg-blue-600 text-white font-bold px-6 py-3 rounded-lg">
                        <i class="fa-solid fa-floppy-disk">GUARDAR</i>
                    </button>
                </div>
            </div>
            

        </div>
    </form>


</x-app-layout>