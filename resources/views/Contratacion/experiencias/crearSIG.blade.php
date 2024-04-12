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
        <title>Añadir experiencias</title>
    </head>
    <form action="{{ route('experiencias.guardar') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="bg-gradient-to-r from-indigo-700 to-indigo-950 p-8">
            <!-- Cuadro exterior con fondo azul marino y relleno de 8 unidades -->
            <div class="bg-gray-100 p-4 overflow-hidden shadow-xl sm:rounded-lg m-5 ">
                <div class= "text-center font-sans text-black font-bold text-3xl antialiased pb-10 mt-10">
                    REGISTRE SUS EXPERIENCIAS
                </div>
                <div>
                    <label class="font-bold text-lg" for="">Cargo</label>
                    <div class="flex -mx-3">
                        <div class="w-full px-3 mb-5">
                            <div class="flex">
                                <div
                                    class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                                    <i class="fa-solid fa-tag"></i>
                                </div>
                                <input id= "cargo" type="string" name="cargo"
                                    class="w-full -ml-10 pl-10 pr-3 py-2 rounded-2xl border-2 border-gray-200 outline-none focus:border-indigo-500"
                                    placeholder="Ingrese el cargo que tuvo" value="{{ old('cargo') }}">
                                @error('cargo')
                                    <strong class = "text-red-500">Debes ingresar el cargo que tuvo</strong>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <label class="font-bold text-lg" for=""> Descripción</label>
                    <div class="flex -mx-3">
                        <div class="w-full px-3 mb-5">
                            <div class="flex">
                                <div
                                    class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                                    <i class="fa-solid fa-money-bill"></i>
                                </div>
                                <input id= "descripcion" type="string" name="descripcion"
                                    class="w-full -ml-10 pl-10 pr-3 py-2 rounded-2xl border-2 border-gray-200 outline-none focus:border-indigo-500"
                                    placeholder="Ingresar la descripción" value="{{ old('descripcion') }}">
                                @error('descripcion')
                                    <strong class = "text-red-500">Debes ingresar la descripción</strong>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>


                <div>
                    <label class="font-bold text-lg" for=""> Años</label>
                    <div class="flex -mx-3">
                        <div class="w-full px-3 mb-5">
                            <div class="flex">
                                <div
                                    class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                                    <i class="fa-solid fa-money-bill"></i>
                                </div>
                                <input id= "años" type="string" name="años"
                                    class="w-full -ml-10 pl-10 pr-3 py-2 rounded-2xl border-2 border-gray-200 outline-none focus:border-indigo-500"
                                    placeholder="Ingresar los años que tuvo en ese cargo" value="{{ old('años') }}">
                                @error('años')
                                    <strong class = "text-red-500">Debes ingresar los años que estuvo bajo ese cargo</strong>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>


                <div>
                    <label class="font-bold text-lg" for=""> Lugar</label>
                    <div class="flex -mx-3">
                        <div class="w-full px-3 mb-5">
                            <div class="flex">
                                <div
                                    class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                                    <i class="fa-solid fa-money-bill"></i>
                                </div>
                                <input id= "lugar" type="string" name="lugar"
                                    class="w-full -ml-10 pl-10 pr-3 py-2 rounded-2xl border-2 border-gray-200 outline-none focus:border-indigo-500"
                                    placeholder="Ingresar el lugar donde trabajo" value="{{ old('lugar') }}">
                                @error('lugar')
                                    <strong class = "text-red-500">Debes ingresar el lugar donde trabajo</strong>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
             
              

                    
                <div class="flex -mx-3 pt-9">
                    <div class="w-full px-3 mb-5">
                        <button type ="submit" id="guardar"
                            class="block w-full max-w-xs mx-auto bg-indigo-500 hover:bg-indigo-700 focus:bg-indigo-700 text-white rounded-lg px-3 py-3 font-semibold">Guardar
                        </button>
                    </div>
                </div>                
          
            </div>
        </div>
        </div>
    </form>
</x-app-layout>