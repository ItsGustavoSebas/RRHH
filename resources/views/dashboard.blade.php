<x-app-layout>
    @if (Auth::user()->postulante)
        <div class="bg-blue-300 flex justify-between mt-[55px]">
            <div class=" max-w-7xl px-4 py-8 bg-blue-300 sm:px-6 lg:px-10 hidden lg:block md:block">
                @if (Auth::user()->postulante->ruta_imagen_e)
                    <img class="flex-1 w-48 rounded-full shadow-lg" src="{{ Auth::user()->postulante->ruta_imagen_e }}"
                        alt="{{ Auth::user()->name }}" />
                @else
                    <img class="flex-1 w-48 rounded-full shadow-lg" src="{{ Auth::user()->profile_photo_url }}"
                        alt="{{ Auth::user()->name }}" />
                @endif
            </div>
            <div>
                <div class="bg-blue-300 max-w-7xl px-4 pt-14 sm:px-6 lg:px-8">
                    <h1 class="text-3xl font-sans tracking-tight text-gray-900">
                        {{ Auth::user()->name }}
                    </h1>
                    @if (Auth::user()->postulante->puesto_disponible)
                        <p class="ml-10">Postulante para {{ Auth::user()->postulante->puesto_disponible->nombre }}</p>
                    @endif
                </div>
                <div class="bg-blue-300 max-w-7xl px-4 sm:px-6 lg:px-8">
                    @if (Auth::user()->postulante->referencias->isEmpty())
                        <p class="ml-10 text-red-500">Información incompleta</p>
                        <p class="ml-10 text-gray-500">Por favor, complete toda la información requerida en su solicitud
                            para continuar con el proceso de postulación.</p>
                    @else
                        @if (Auth::user()->postulante->estado === 0)
                            <p class="ml-10 text-red-500">Rechazado</p>
                            <p class="ml-10 text-gray-500">Lamentablemente, su solicitud ha sido rechazada en esta
                                ocasión.
                                Sin embargo, lo invitamos a seguir revisando nuestras oportunidades de trabajo y
                                postularse
                                a otros puestos que puedan ser de su interés.</p>
                        @else
                            @if (!Auth::user()->postulante->entrevista && !Auth::user()->postulante->contrato)
                                <p class="ml-10 text-green-500 fond-bold">Pendiente de revisión</p>
                                <p class="ml-10 text-gray-500">Su solicitud ha sido enviada y está siendo revisada por
                                    el
                                    equipo
                                    de
                                    reclutamiento. Por favor, espere mientras procesamos su solicitud.</p>
                            @endif

                            @if (Auth::user()->postulante->entrevista)
                                @if (!Auth::user()->postulante->entrevista->puntos)
                                    <p class="ml-10 text-green-500 fond-bold">Programado para entrevista</p>
                                    <p class="ml-10 text-gray-500">Ha sido programado para una entrevista. Por favor,
                                        asegúrese
                                        de
                                        prepararse adecuadamente y estar disponible en el momento programado.</p>
                                @else
                                    <p class="ml-10 text-green-500 fond-bold">Entrevista realizada</p>
                                    <p class="ml-10 text-gray-500">Ha completado con éxito la entrevista. Ahora estamos
                                        evaluando su
                                        desempeño y pronto nos pondremos en contacto con usted con más información.</p>
                                @endif
                            @endif

                            @if (Auth::user()->postulante->contrato)
                                <p class="ml-10 text-green-500">Oferta extendida</p>
                                <p class="ml-10 text-gray-500">Le hemos extendido una oferta de empleo. Por favor,
                                    revise
                                    los
                                    términos y condiciones de la oferta y contáctenos si tiene alguna pregunta o desea
                                    discutir
                                    los
                                    detalles.</p>
                            @endif
                        @endif
                    @endif
                </div>
            </div>


            <div class="bg-blue-300 mx-auto max-w-7xl px-4 py-20 sm:px-6 lg:px-8">

                <div class="flex justify-between">

                    <div class="flex-1">
                    </div>

                    <!-- Buttons -->
                    <div class="flex space-x-4 space-y-4 lg:block md:block">
                        @if (Auth::user()->postulante->estado === 0)
                            <a href="{{ route('puesto_disponibles.disponibles') }}"
                                class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded-md">Puestos
                                disponibles</a>
                        @else
                            @if (Auth::user()->postulante->entrevista)
                                @if (!Auth::user()->postulante->entrevista->puntos)
                                    <a href="{{ route('entrevistas.visualizar', Auth::user()->postulante->entrevista->id) }}"
                                        class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded-md">Información
                                        de
                                        la Entrevista</a>
                                @endif
                            @endif
                            @if (Auth::user()->postulante->contrato)
                                <a href="{{ route('contrato.visualizar', Auth::user()->postulante->contrato->id) }}"
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded-md">Información
                                    del
                                    contrato</a>
                            @endif

                            @if (Auth::user()->postulante->referencias->isEmpty())
                                <a class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded-md"
                                    href="{{ route('postulantes.postularse') }}">Continuar
                                    Proceso</a>
                            @endif
                        @endif
                        <button class="bg-gray-500 hover:bg-gray-600 text-white px-2 py-1 rounded-md"
                            onclick="window.location.href='{{ route('postulantes.editarinfo', Auth::user()->id) }}'">Editar</button>

                    </div>

                </div>

            </div>

        </div>

        <x-tabla-informacion :opcional="$opcional" />
    @endif
    <script>
        @if (Session::has('eliminado'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
            }
            toastr.success("{{ session('eliminado') }}")
        @endif
        @if (Session::has('actualizado'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
            }
            toastr.success("{{ session('actualizado') }}")
        @endif
        @if (Session::has('creado'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
            }
            toastr.success("{{ session('creado') }}")
        @endif
    </script>
</x-app-layout>
