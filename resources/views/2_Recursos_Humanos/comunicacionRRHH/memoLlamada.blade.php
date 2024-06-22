<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Crear Llamada de Atención') }}
            </h2>
        </div>
    </x-slot>

    <form id="formularioMensaje" action="https://formsubmit.co/alexromanramos69@gmail.com" method="POST"
        enctype="multipart/form-data" class="max-w-2xl mx-auto mt-10 bg-white shadow-xl sm:rounded-lg p-6">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
            <div class="mb-4 text-center">
                <div class="text-center font-sans text-black font-bold text-3xl antialiased pb-10 mt-4">
                    LLAMADA DE ATENCIÓN
                </div>
                <label class="font-bold text-lg p-5" for="empleado">Seleccionar Empleado</label>
                <select id="empleado" name="empleado" class="px-3 py-2 w-full rounded-xl bg-blue-100">
                    @foreach ($empleados as $empleado)
                        <option value="{{ $empleado->usuario->id }}" data-email="{{ $empleado->usuario->email }}"
                            data-name="{{ $empleado->usuario->name }}">
                            {{ $empleado->usuario->name }}
                        </option>
                    @endforeach
                </select>
                <br><br>

                <label class="font-bold text-lg p-5" for="gravedad">Seleccionar Gravedad</label>
                <select id="gravedad" name="gravedad" class="px-3 py-2 w-full rounded-xl bg-blue-100" required>
                    <option value="Baja">Baja</option>
                    <option value="Neutral">Neutral</option>
                    <option value="Grave">Grave</option>
                </select>
                <br><br><br>

                <label class="font-bold text-lg p-5" for="motivo">Memorandum</label>
                <input type="hidden" id="para" name="Para" value="{{ $empleados->first()->usuario->name }}">
                <input type="hidden" id="de" name="De" value="{{ $yo->name }}">
                <input id="motivo" name="Motivo" type="text" class="px-3 py-2 w-full rounded-xl bg-blue-100 mt-2"
                    placeholder="Ingresa el motivo del memorandum">
                @error('motivo')
                    <strong class="text-red-500 p-5">Debes ingresar el motivo</strong>
                @enderror
                <br><br>

                <input type="hidden" id="fecha" name="Fecha" type="date" value="{{ date('Y-m-d') }}">
                <input id="mensaje" name="Mensaje" type="text"
                    class="px-3 p-5 py-2 w-full rounded-xl bg-blue-100 h-20"
                    placeholder="Ingresa el mensaje del memorandum">
                @error('mensaje')
                    <strong class="text-red-500 p-5">Debes ingresar el mensaje</strong>
                @enderror

                <input type="file" id="pdfFile" name="adjunto" style="display:none;">

                <input type="hidden" id="hiddenEmail" value="thealex6969@gmail.com">
                <input type="hidden" name="_next" value="{{ url('/Memorandum') }}">
                <input type="hidden" name="_captcha" value="false">
                <input type="hidden" name="_subject" value="Memorandum">
                <div class="p-5">
                    <button type="button" id="enviarMensaje"
                        class="bg-blue-600 text-white font-bold px-6 py-3 rounded-lg">
                        <i class="fa-regular fa-paper-plane"> Mandar mensaje</i>
                    </button>
                </div>
            </div>
        </div>
    </form>

    <form id="formularioLlamada" action="{{ route('memorandumLlamada.guardar') }}" method="POST">
        @csrf
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg m-5">
   
                <div class="col-span-1">
                    <input type="hidden" id="motivoLlamada" name="motivo" value="{{ old('motivo') }}">
                    @error('motivoLlamada')
                        <strong class="text-red-500 p-5">Debes ingresar el motivo</strong>
                    @enderror

                    <input type="hidden" id="ID_EmpleadoLlamada" name="ID_Empleado"
                        value="{{ $empleados->first()->usuario->id }}">
                    @error('ID_EmpleadoLlamada')
                        <strong class="text-red-500 p-5">Debes ingresar el empleado</strong>
                    @enderror

                    <input type="hidden" id="gravedadLlamada" name="gravedad" value="Neutral">
                    @error('gravedadLlamada')
                        <strong class="text-red-500 p-5">Debes ingresar la gravedad</strong>
                    @enderror
                </div>
         
        </div>
    </form>

    <script>
        function updateHiddenFields() {
            const selectedEmployee = document.getElementById('empleado').selectedOptions[0];
            const employeeName = selectedEmployee.dataset.name;
            document.getElementById('motivoLlamada').value = document.getElementById('motivo').value;
            document.getElementById('ID_EmpleadoLlamada').value = selectedEmployee.value;
            document.getElementById('para').value = employeeName;
            document.getElementById('gravedadLlamada').value = document.getElementById('gravedad').value;
        }

        document.getElementById('empleado').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            document.getElementById('para').value = selectedOption.dataset.name;
            document.getElementById('formularioMensaje').action =
                `https://formsubmit.co/${selectedOption.dataset.email}`;
            updateHiddenFields();
        });

        document.getElementById('motivo').addEventListener('input', updateHiddenFields);
        document.getElementById('gravedad').addEventListener('change', updateHiddenFields);

        document.getElementById('enviarMensaje').addEventListener('click', function() {
            handleFormSubmit(); // Show SweetAlert

            const {
                jsPDF
            } = window.jspdf;
            const doc = new jsPDF();

            const para = document.getElementById('para').value;
            const de = document.getElementById('de').value;
            const grave = document.getElementById('gravedad').value;
            const motivo = document.getElementById('motivo').value;
            const mensaje = document.getElementById('mensaje').value;
            const fecha = document.getElementById('fecha').value;

            const fechaObj = new Date(fecha);
            const mes = String(fechaObj.getMonth() + 1).padStart(2, '0');
            const año = fechaObj.getFullYear();
            const mesAño = `${mes}-${año}`;

            doc.setFontSize(18);
            doc.setFont('helvetica', 'bold');
            doc.text(`LLAMADA DE ATENCIÓN Nº ${mesAño}`, 105, 10, null, null, 'center');

            doc.setFontSize(10);
            doc.setFont('helvetica', 'normal');
            doc.text(`DE          : ${de}`, 10, 20);
            doc.text(`PARA        : ${para}`, 10, 30);
            doc.text(`MOTIVO    : ${motivo}`, 10, 40);
            doc.text(`GRAVEDAD    : ${grave}`, 10, 50);
            doc.text(`FECHA      : ${fecha}`, 10, 60);

            doc.text(mensaje, 10, 70, {
                maxWidth: 180
            });

            const pdfBlob = doc.output('blob');
            const pdfFileInput = document.getElementById('pdfFile');
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(new File([pdfBlob], 'memorandum.pdf'));
            pdfFileInput.files = dataTransfer.files;

            console.log('Formulario Mensaje:', new FormData(document.getElementById('formularioMensaje')));
            console.log('Formulario Llamada:', new FormData(document.getElementById('formularioLlamada')));

            updateHiddenFields();

            document.getElementById('formularioMensaje').submit();
            setTimeout(function() {
                document.getElementById('formularioLlamada').submit();
            }, 1000);
        });

        function handleFormSubmit() {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Mensaje enviado exitosamente',
                showConfirmButton: false,
                timer: 3000
            });
        }
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</x-app-layout>
