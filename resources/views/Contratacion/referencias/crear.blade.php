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
        <title>Añadir referencias</title>
    </head>
    <form action="{{ route('referencias.guardar') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="bg-gradient-to-r from-indigo-700 to-indigo-950 p-8">
            <!-- Cuadro exterior con fondo azul marino y relleno de 8 unidades -->
            <div class="bg-gray-100 p-4 overflow-hidden shadow-xl sm:rounded-lg m-5 ">
                <div class= "text-center font-sans text-black font-bold text-3xl antialiased pb-10 mt-10">
                    REGISTRE SUS REFERENCIAS
                </div>
                <div>
                    <label class="font-bold text-lg" for="">Nombre de la persona</label>
                    <div class="flex -mx-3">
                        <div class="w-full px-3 mb-5">
                            <div class="flex">
                                <div
                                    class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                                    <i class="fa-solid fa-tag"></i>
                                </div>
                                <input id= "nombre" type="string" name="nombre"
                                    class="w-full -ml-10 pl-10 pr-3 py-2 rounded-2xl border-2 border-gray-200 outline-none focus:border-indigo-500"
                                    placeholder="Ingrese el nombre de la persona" value="{{ old('nombre') }}">
                                @error('nombre')
                                    <strong class = "text-red-500">Debes ingresar el nombre de la persona</strong>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <label class="font-bold text-lg" for=""> Telefono</label>
                    <div class="flex -mx-3">
                        <div class="w-full px-3 mb-5">
                            <div class="flex">
                                <div
                                    class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                                    <i class="fa-solid fa-money-bill"></i>
                                </div>
                                <input id= "telefono" type="string" name="telefono"
                                    class="w-full -ml-10 pl-10 pr-3 py-2 rounded-2xl border-2 border-gray-200 outline-none focus:border-indigo-500"
                                    placeholder="Ingresar telefono telefono" value="{{ old('telefono') }}">
                                @error('telefono')
                                    <strong class = "text-red-500">Debes ingresar el telefono</strong>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="font-bold text-lg" for="">Descripción de la referencia</label>
                    <div class="flex -mx-3">
                        <div class="w-full px-3 mb-5">
                            <div class="flex">
                                <div
                                    class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                                    <i class="fa-solid fa-tag"></i>
                                </div>
                                <input id= "descripcion" type="string" name="descripcion"
                                    class="w-full -ml-10 pl-10 pr-3 py-2 rounded-2xl border-2 border-gray-200 outline-none focus:border-indigo-500"
                                    placeholder="Ingrese la descripción" value="{{ old('descripcion') }}">
                                @error('descripcion')
                                    <strong class = "text-red-500">Debes ingresar la Descripción</strong>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
             
              



                     
                <div class="flex -mx-3 pt-9">
                    <div class="w-full px-3 mb-5">
                        <button type="submit" name="action" value="guardar_y_anadir_otro"
                            class="block w-full max-w-xs mx-auto bg-indigo-500 hover:bg-indigo-700 focus:bg-indigo-700 text-white rounded-lg px-3 py-3 font-semibold">Guardar y añadir otro
                        </button>
                    </div>
                </div>

                <div class="flex -mx-3 pt-9">
                    <div class="w-full px-3 mb-5">
                        <button type="submit" name="action" value="guardar_y_siguiente"
                            class="block w-full max-w-xs mx-auto bg-indigo-500 hover:bg-indigo-700 focus:bg-indigo-700 text-white rounded-lg px-3 py-3 font-semibold">Guardar y finalizar
                        </button>
                    </div>
                </div>          
          
            </div>
        </div>
        </div>
    </form>
</x-app-layout>