<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar información') }}
        </h2>
    </x-slot>

    <title>Editar información</title>

    <form action="{{ route('postulantes.actualizar', ['id' => auth()->id()]) }}" method="POST">
        @csrf
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg m-5">

            <div class= "text-center font-sans text-black font-bold text-3xl antialiased  mt-10">
                Edite su información
            </div>

            <div class="grid lg:grid-cols-1 grid-cols-1 gap-4 p-5">
                <div class="col-span-1">
                    <label class="font-bold text-lg" for="ruta_imagen_e">Foto </label>
                    <input id="ruta_imagen_e" name="ruta_imagen_e" type="text" class="px-3 py-2 w-full rounded-xl bg-blue-100" placeholder="Suba su foto" value="{{ $postulante->ruta_imagen_e }}">
                    @error('ruta_imagen_e')
                        <strong class="text-red-500">Debes subir su foto</strong>
                    @enderror
                </div>
                <br>
                            
                <div class="col-span-1">
                    <label class="font-bold text-lg" for="fecha_de_nacimiento">Fecha de nacimiento</label></label>
                    <input id="fecha_de_nacimiento" name="fecha_de_nacimiento" type="date" class="px-3 py-2 w-full rounded-xl bg-blue-100" placeholder="Ingrese su fecha de nacimiento" value="{{ $postulante->fecha_de_nacimiento }}">
                    @error('fecha_de_nacimiento')
                        <strong class="text-red-500">Debes ingresar su fecha de nacimiento</strong>
                    @enderror
                </div>
                            
                <br>

                <div class="col-span-1">
                    <label class="font-bold text-lg" for="nacionalidad">Nacionalidad</label>
                    <input id="nacionalidad" name="nacionalidad" type="text" class="px-3 py-2 w-full rounded-xl bg-blue-100" placeholder="Ingrese su nacionalidad " value="{{ $postulante->nacionalidad }}">
                    @error('nacionalidad')
                        <strong class="text-red-500">Debes ingresar su nacionalidad</strong>
                    @enderror
                </div>
                            
                <br>

                <div class="col-span-1">
                    <label class="font-bold text-lg" for="habilidades">Habilidades</label>
                    <input id="habilidades" name="habilidades" type="text" class="px-3 py-2 w-full rounded-xl bg-blue-100" placeholder="Ingrese alguna habilidad suya" value="{{ $postulante->habilidades }}">
 
                </div>

                <br>

                <div>
                    <label class="font-bold text-lg" for=""> Fuente de contratación</label>
                    <div class="flex -mx-3">
                        <div class="w-full px-3 mb-5">
                            <div class="flex">
                                <div
                                    class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                                    <i class="fa-solid fa-filter"></i>
                                </div>
                                <select name="ID_Fuente_De_Contratacion" id="ID_Fuente_De_Contrataciona" class="w-full -ml-10 pl-10 pr-3 py-2 rounded-2xl border-2 border-gray-200 outline-none focus:border-indigo-500">
                                    <option value="">Selecciona una fuente de contratación</option>
                                    @foreach ($fuentes as $fuente)
                                        <option value="{{ $fuente->id }}" {{ $postulante->ID_Fuente_De_Contratacion == $fuente->id ? 'selected' : '' }}>
                                            {{ $fuente->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                
                            </div>
                            @error('ID_Fuente_De_Contratacion')
                                <strong class = "text-red-500">Debes ingresar la fuente de contratación</strong>
                            @enderror
                        </div>
                    </div>
                </div>


                <div>
                    <label class="font-bold text-lg" for=""> Puestos disponibles</label>
                    <div class="flex -mx-3">
                        <div class="w-full px-3 mb-5">
                            <div class="flex">
                                <div
                                    class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                                    <i class="fa-solid fa-filter"></i>
                                </div>
                                <select name="ID_Puesto_Disponible" id="ID_Puesto_Disponiblea" class="w-full -ml-10 pl-10 pr-3 py-2 rounded-2xl border-2 border-gray-200 outline-none focus:border-indigo-500">
                                    <option value="">Selecciona un puesto</option>
                                    @foreach ($puestos as $puesto)
                                        <option value="{{ $puesto->id }}" {{ $postulante->ID_Puesto_Disponible == $puesto->id ? 'selected' : '' }}>
                                            {{ $puesto->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                
                            </div>
                            @error('ID_Puesto_Disponible')
                                <strong class = "text-red-500">Debes ingresar un puesto</strong>
                            @enderror
                        </div>
                    </div>
                </div>


                <div>
                    <label class="font-bold text-lg" for="">Segundo idioma</label>
                    <div class="flex -mx-3">
                        <div class="w-full px-3 mb-5">
                            <div class="flex">
                                <div
                                    class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                                    <i class="fa-solid fa-filter"></i>
                                </div>
                                <select name="ID_Idioma" id="ID_Idiomaa" class="w-full -ml-10 pl-10 pr-3 py-2 rounded-2xl border-2 border-gray-200 outline-none focus:border-indigo-500">
                                    <option value="">Selecciona un segundo idioma que sepa</option>
                                    @foreach ($idiomas as $idioma)
                                        <option value="{{ $idioma->id }}" {{ $postulante->ID_Idioma == $idioma->id ? 'selected' : '' }}>
                                            {{ $idioma->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('ID_Idioma')
                                <strong class = "text-red-500">Debes ingresar un idioma</strong>
                            @enderror
                        </div>
                    </div>
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