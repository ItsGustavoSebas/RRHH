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
        <title>Registrar datos del contrato</title>
    </head>
    <form action="{{ route('precontratos.guardar', $postulante->ID_Usuario ) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="bg-gradient-to-r from-indigo-700 to-indigo-950 p-8">
            <!-- Cuadro exterior con fondo azul marino y relleno de 8 unidades -->
            <div class="bg-gray-100 p-4 overflow-hidden shadow-xl sm:rounded-lg m-5 ">
                <div class= "text-center font-sans text-black font-bold text-3xl antialiased pb-10 mt-10">
                    REGISTRAR PRE CONTRATO PARA EL POSTULANTE: {{ $postulante->usuario->name }}
                </div>
                <div>
                    <label class="font-bold text-lg" for=""> Genero</label>
                    <div class="flex -mx-3">
                        <div class="w-full px-3 mb-5">
                            <div class="flex">
                                <div
                                    class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                                    <i class="fa-solid fa-user text-gray-400 text-lg"></i>
                                </div>
                                <input id= "genero" type="text" name="genero"
                                    class="w-full -ml-10 pl-10 pr-3 py-2 rounded-2xl border-2 border-gray-200 outline-none focus:border-indigo-500"
                                    placeholder="Ingresar el genero del postulante" value="{{ old('genero') }}">
                                @error('genero')
                                <strong class = "text-red-500">Debes ingresar un genero.</strong>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <label class="font-bold text-lg" for=""> Estado civil</label>
                    <div class="flex -mx-3">
                        <div class="w-full px-3 mb-5">
                            <div class="flex">
                                <div
                                    class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                                    <i class="fa-solid fa-envelope text-gray-400 text-lg"></i>
                                </div>
                                <input id= "estadocivil" type="estadocivil" name="estadocivil"
                                    class="w-full -ml-10 pl-10 pr-3 py-2 rounded-2xl border-2 border-gray-200 outline-none focus:border-indigo-500"
                                    placeholder="ingresar el estado civil del postulante" value="{{ old('estadocivil') }}"v>
                                @error('estadocivil')
                                <strong class = "text-red-500">Debes ingresar el estado civil del postulante.</strong>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex -mx-3">
                        <!-- Campo de Departamento -->
                        <div class="w-1/2 px-3 mb-5">
                            <label class="font-bold text-lg" for=""> Departamento</label>
                            <div class="flex -mx-3">
                                <div class="w-full px-3 mb-5">
                                    <div class="flex">
                                        <div
                                            class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                                            <i class="fa-regular fa-registered"></i>
                                        </div>
                                        <select name="ID_Departamento" id="ID_Departamento"
                                            class="w-full -ml-10 pl-10 pr-3 py-2 rounded-2xl border-2 border-gray-200 outline-none focus:border-indigo-500">
                                            <option value="">Selecciona el Departamento</option>
                                            @foreach ($departamentos as $departamento)
                                                <option value="{{ $departamento->id }}">{{ $departamento->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('ID_Departamento')
                                        <strong class = "text-red-500">Debe seleccionar el Departamento</strong>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex -mx-3">
                        <!-- Campo de Roles -->
                        <div class="w-1/2 px-3 mb-5">
                            <label class="font-bold text-lg" for="rol">Seleccionar Rol</label>
                            <div>
                                @foreach ($roles as $rol)
                                    <label for="{{ $rol->id }}">
                                        <input type="radio" name="rol" value="{{ $rol->id }}" id="{{ $rol->id }}">
                                        {{ $rol->name }}
                                    </label>
                                @endforeach
                            </div>
                        
                            @error('rol')
                                <strong class="text-red-500 font-bold">Selecciona un Rol</strong>
                            @enderror
                        </div>
                        
                        <!-- Campo de Cargo -->
                        <div class="w-1/2 px-3 mb-5" id="cargo-container">
                            <label class="font-bold text-lg" for=""> Cargo</label>
                            <div class="flex -mx-3">
                                <div class="w-full px-3 mb-5">
                                    <div class="flex">
                                        <div
                                            class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                                            <i class="fa-regular fa-registered"></i>
                                        </div>
                                        <select name="ID_Cargo" id="ID_Cargo"
                                            class="w-full -ml-10 pl-10 pr-3 py-2 rounded-2xl border-2 border-gray-200 outline-none focus:border-indigo-500">
                                            <option value="">Selecciona el Cargo</option>
                                            @foreach ($cargos as $cargo)
                                            <option value="{{ $cargo->id }}" data-departamento="{{ $cargo->ID_Departamento }}">{{ $cargo->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('ID_Cargo')
                                        <strong class = "text-red-500">Debe seleccionar el Cargo</strong>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="flex -mx-3 pt-9">
                        <div class="w-full px-3 mb-5">
                            <button type ="submit" id="registrar"
                                class="block w-full max-w-xs mx-auto bg-indigo-500 hover:bg-indigo-700 focus:bg-indigo-700 text-white rounded-lg px-3 py-3 font-semibold">REGISTRAR PRE CONTRATO
                            </button>
                        </div>
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
                    if (option.getAttribute('data-departamento') === selectedDepartamento || option.value === "") {
                        option.style.display = 'block';
                    } else {
                        option.style.display = 'none';
                    }
                });
            });
        });
    </script>
</x-app-layout>
