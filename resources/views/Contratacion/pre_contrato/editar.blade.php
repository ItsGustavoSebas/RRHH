<x-app-layout>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- Scripts -->
        <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.4.2/zxcvbn.js"></script>

        <style>
            @import url('https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.min.css');
        </style>
        <title>Editar_Empleado</title>
    </head>
    <form method="POST" action="{{ route('precontratos.actualizar', $postulante->ID_Usuario) }}" enctype="multipart/form-data"
        autocomplete="off">
        @csrf
        @method('POST')
        <div class="bg-gradient-to-r from-indigo-700 to-indigo-950 p-8">
            <!-- Cuadro exterior con fondo azul marino y relleno de 8 unidades -->
            <div class="bg-gray-100 p-4 overflow-hidden shadow-xl sm:rounded-lg m-5 ">
                <div class= "text-center font-sans text-black font-bold text-3xl antialiased pb-10 mt-10">
                    EDITAR PRE CONTRATO DEL POSTULANTE: {{ $postulante->usuario->name }}
                </div>
                <div>
                    <label class="font-bold text-lg" for=""> Genero</label>
                    <div class="flex">
                        <div class="w-full px-3 mb-5">
                            <div class="flex">
                                <div
                                    class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                                    <i class="fa-solid fa-user text-gray-400 text-lg"></i>
                                </div>
                                <input id= "genero" type="text" name="genero"
                                    class="w-full -ml-10 pl-10 pr-3 py-2 rounded-2xl border-2 border-gray-200 outline-none focus:border-indigo-500"
                                    placeholder="Ingresar genero del postulante" value="{{ $pre_contrato->genero }}">
                                @error('genero')
                                   <strong class = "text-red-500">Debes ingresar el genero.</strong>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <label class="font-bold text-lg" for=""> Estado civil del postulante</label>
                    <div class="flex">
                        <div class="w-full px-3 mb-5">
                            <div class="flex">
                                <div
                                    class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                                    <i class="fa-solid fa-envelope text-gray-400 text-lg"></i>
                                </div>
                                <input id= "estadocivil" type="estadocivil" name="estadocivil"
                                    class="w-full -ml-10 pl-10 pr-3 py-2 rounded-2xl border-2 border-gray-200 outline-none focus:border-indigo-500"
                                    placeholder="ingresar el estado civil del postulante" value="{{ $pre_contrato->estadocivil }}"v>
                                @error('estadocivil')
                                <strong class = "text-red-500">Debes ingresar el estado civil del postulante.</strong>
                                @enderror
                            </div>
                        </div>
                    </div>
                        <!-- Campo Departamento -->
                        <div class="w-1/2 px-3 mb-5">
                            <label class="font-bold text-lg" for="departamento">Departamento</label>
                            <div class="flex">
                                <div
                                    class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                                    <i class="fa-solid fa-user text-gray-400 text-lg"></i>
                                </div>
                                <select name="ID_Departamento" id="ID_Departamento"
                                    class="w-full -ml-10 pl-10 pr-3 py-2 rounded-2xl border-2 border-gray-200 outline-none focus:border-indigo-500">
                                    <option value="">Selecciona el Departamento</option>
                                    @foreach ($departamentos as $departamento)
                                        <option value="{{ $departamento->id }}"
                                            @if ($departamento->id == $pre_contrato->departamento->id) selected @endif>
                                            {{ $departamento->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('departamento')
                               <strong class = "text-red-500">Debes seleccionar un departamento.</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="flex -mx-3">
                        <div class="w-1/2 px-3 mb-5">
                            <label class="font-bold text-lg" for="roles">Seleccionar Rol</label>
                            <div>
                                @foreach ($roles as $rol)
                                <label for="{{ $rol->id }}">
                                    <input type="radio" 
                                           name="rol" 
                                           value="{{ $rol->id }}" 
                                           id="{{ $rol->id }}" 
                                           class="mr-1" 
                                           {{ $rol->id == $pre_contrato->rol ? 'checked' : '' }} />
                                    {{ $rol->name }}
                                </label>
                                @endforeach
                            </div>
                        
                            @error('roles')
                                <strong class="text-red-500 font-bold">Selecciona un Rol</strong>
                            @enderror
                        </div>
                        

                        <!-- Cargo -->
                        <div class="w-1/2 pl-3" id="cargo-container">
                            <label class="font-bold text-lg" for="ID_Cargo">Cargo</label>
                            <div class="flex">
                                <div
                                    class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                                    <i class="fa-regular fa-registered"></i>
                                </div>
                                <select name="ID_Cargo" id="ID_Cargo"
                                    class="w-full -ml-10 pl-10 pr-3 py-2 rounded-2xl border-2 border-gray-200 outline-none focus:border-indigo-500">
                                    <option value="">Selecciona el Cargo</option>
                                    @foreach ($cargos as $cargo)
                                        <option value="{{ $cargo->id }}"
                                            data-departamento="{{ $cargo->ID_Departamento }}"
                                            @if ($cargo->id == $pre_contrato->cargo->id) selected @endif>{{ $cargo->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <br>
                    

                    <!-- Botón de registro -->
                    <div class="w-full px-3 mb-5">
                        <button type="submit" id="registrar"
                            class="block w-full max-w-xs mx-auto bg-indigo-500 hover:bg-indigo-700 focus:bg-indigo-700 text-white rounded-lg px-3 py-3 font-semibold">ACTUALIZAR PRE CONTRATO</button>
                    </div>

                </div>
            </div>
        </div>
    </form>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Obtiene el contenedor de cargos
            const cargoContainer = document.getElementById('cargo-container');
            // Obtiene el select de departamento
            const departamentoSelect = document.getElementById('ID_Departamento');
            // Obtiene todos los options de cargos
            const cargoOptions = cargoContainer.querySelectorAll('option');

            // Agrega un evento change al select de departamento
            departamentoSelect.addEventListener('change', function() {
                const selectedDepartamento = this.value; // Obtiene el valor seleccionado del departamento
                // Itera sobre todas las opciones de cargos
                cargoOptions.forEach(option => {
                    // Si el valor de data-departamento coincide con el departamento seleccionado, muestra la opción, de lo contrario, ocúltala
                    if (option.getAttribute('data-departamento') === selectedDepartamento || option
                        .value === "") {
                        option.style.display = 'block';
                    } else {
                        option.style.display = 'none';
                    }
                });
            });
        });
    </script>
</x-app-layout>
