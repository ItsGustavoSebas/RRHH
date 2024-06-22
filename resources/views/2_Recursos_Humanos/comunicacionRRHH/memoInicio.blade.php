<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('MEMORANDUM & LLAMADAS DE ATENCION') }}
        </h2>
    </x-slot>

    <section class="bg-white py-24 px-4 lg:px-16">
        <div class="container mx-auto px-[12px] md:px-24 xl:px-12 max-w-[1300px] nanum2">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-4 gap-y-28 lg:gap-y-16 justify-center text-center">
                <!-- Primer elemento del grid -->
                <div class="relative group h-48 flex flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
                    <a href="{{ route('memorandum.inicio') }}" class="block">
                       
                        <div class="h-28">
                            <div class="absolute -top-20 lg:top-[-10%] left-[5%] z-40 group-hover:top-[-40%] group-hover:opacity-[0.9] duration-300 w-[90%] h-48 bg-red-500 rounded-xl justify-items-center align-middle">
                                <img src="https://cdn-icons-png.flaticon.com/512/9750/9750543.png" class="w-36 h-36 mt-6 m-auto" alt="Automotive" title="Automotive" loading="lazy" width="200" height="200">
                            </div>
                        </div>
                        <div class="p-6 z-10 w-full">
                            <p class="mb-2 inline-block text-tg text-center w-full text-xl font-sans font-semibold leading-snug tracking-normal antialiased">
                                Memorandum
                            </p>
                        </div>
                    </a>
                </div>

                <!-- Segundo elemento del grid -->
                <div class="relative group h-48 flex flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
                    <a href="{{ route('memorandumLlamada.inicio') }}" class="block">
                        <div class="h-28">
                            <div class="absolute -top-20 lg:top-[-10%] left-[5%] z-40 group-hover:top-[-40%] group-hover:opacity-[0.9] duration-300 w-[90%] h-48 bg-red-500 rounded-xl justify-items-center align-middle">
                                <img src="https://cdn-icons-png.freepik.com/512/7521/7521236.png" class="w-36 h-36 mt-6 m-auto" alt="Toys and Baby Products" title="Toys and Baby Products" loading="lazy" width="200" height="200">
                            </div>
                        </div>
                        <div class="p-6 z-10 w-full">
                            <p class="mb-2 inline-block text-tg text-center w-full text-xl font-sans font-semibold leading-snug tracking-normal antialiased">
                                Llamada de atención
                            </p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
