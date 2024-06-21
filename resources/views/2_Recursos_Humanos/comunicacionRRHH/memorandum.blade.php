<!-- resources/views/actividades/inicio.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('CREAR MEMORANDUM') }}
            </h2>
            @can('Crear Actividades')
                <a href="{{ route('actividades.crear') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg">
                    Llamada de atención
                </a>
            @endcan
        </div>
    </x-slot>

    <form id="formularioMensaje" action="https://formsubmit.co/alexromanramos69@gmail.com" method="POST"
        enctype="multipart/form-data" class="max-w-2xl mx-auto mt-10 bg-white shadow-xl sm:rounded-lg p-6">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
            <div class="mb-4 text-center">
                
                <label class="font-bold text-lg p-5 text-center" for="tipoMemo">Tipo de Memorandum</label>
                <div class="p-5">
                    <input type="radio" id="individual" name="tipoMemo" value="individual" checked>
                    <label for="individual">Memorandum individual</label>
                    <br>
                    <input type="radio" id="departamental" name="tipoMemo" value="departamental">
                    <label for="departamental">Memorandum departamental</label>
                </div>

                <label class="font-bold text-lg p-5" for="empleado" id="labelEmpleado">Seleccionar Empleado</label>
                <select type="hidden" id="empleado" name="empleado" class="px-3 py-2 w-full rounded-xl bg-blue-100">
                    @foreach ($empleados as $empleado)
                        <option value="{{ $empleado->usuario->name }}" data-email="{{ $empleado->usuario->email }}">
                            {{ $empleado->usuario->name }}

                        </option>
                    @endforeach
                </select>

                <label class="font-bold text-lg p-5" for="departamento" id="labelDepartamento"
                    style="display: none;">Seleccionar Departamento</label>
                <select type="hidden" id="departamento" name="departamento" class="px-3 py-2 w-full rounded-xl bg-blue-100"
                    style="display: none;">
                    @foreach ($departamentos as $departamento)
                        <option value="{{ $departamento->id }}">
                            {{ $departamento->nombre }}
                        </option>
                    @endforeach
                </select>

                <br>
                <br>
                <br>
                <br>

                <div class="mb-4">
                    <label class="font-bold text-lg" for="motivo">Memorandum</label>
                    <input type="hidden" id="para" name="Para"
                        value="{{ $empleados->first()->usuario->name }}">
                    <input type="hidden" id="de" name="De" value="{{ $yo->name }}">
                    
                    <input id="asunto" name="Asunto" type="text"
                        class="px-3 py-2 w-full rounded-xl bg-blue-100 mt-2"
                        placeholder="Ingresa el asunto del memorandum">
                    @error('asunto')
                        <strong class="text-red-500">Debes ingresar el asunto</strong>
                    @enderror
                </div>

                <div class="mb-4">
                    <input type="hidden" id="fecha" name="Fecha" type="date" value="{{ date('Y-m-d') }}">
                    <input id="mensaje" name="Mensaje" type="text"
                        class="px-3 py-2 w-full rounded-xl bg-blue-100 mt-2"
                        placeholder="Ingresa el mensaje del memorandum">
                    @error('mensaje')
                        <strong class="text-red-500">Debes ingresar el mensaje</strong>
                    @enderror
                </div>

                <input type="hidden" id="hiddenEmail" value="thealex6969@gmail.com">
                <input type="hidden" id="saludos" name="Saludos" value="Saludos a UD.">
                <input type="hidden" name="_next" value="{{ route('comunicacion.rinicio') }}">
                <input type="hidden" name="_captcha" value="false">
                <input type="hidden" name="_subject" value="Memorandum">
                <input type="file" id="pdfFile" name="adjunto" style="display:none;">

                <div class="text-center mt-6">
                    <button type="button" id="enviarMensaje"
                        class="bg-blue-600 hover:bg-blue-800 text-white font-bold px-6 py-3 rounded-lg transition duration-200">
                        <i class="fa-regular fa-paper-plane"></i> Mandar mensaje
                    </button>
                </div>
            </div>
    </form>


    <script>
        document.querySelectorAll('input[name="tipoMemo"]').forEach((elem) => {
            elem.addEventListener('change', function() {
                if (this.value === 'individual') {
                    document.getElementById('labelEmpleado').style.display = 'block';
                    document.getElementById('empleado').style.display = 'block';
                    document.getElementById('labelDepartamento').style.display = 'none';
                    document.getElementById('departamento').style.display = 'none';
                } else if (this.value === 'departamental') {
                    document.getElementById('labelEmpleado').style.display = 'none';
                    document.getElementById('empleado').style.display = 'none';
                    document.getElementById('labelDepartamento').style.display = 'block';
                    document.getElementById('departamento').style.display = 'block';
                }
            });
        });

        document.getElementById('empleado').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            document.getElementById('para').value = selectedOption.value;
            document.getElementById('formularioMensaje').action =
                `https://formsubmit.co/${selectedOption.dataset.email}`;
        });

        document.getElementById('enviarMensaje').addEventListener('click', function() {
            const {
                jsPDF
            } = window.jspdf;
            const doc = new jsPDF();

            const de = document.getElementById('de').value;
            const asunto = document.getElementById('asunto').value;
            const mensaje = document.getElementById('mensaje').value;
            const fecha = document.getElementById('fecha').value;

            const fechaObj = new Date(fecha);
            const mes = String(fechaObj.getMonth() + 1).padStart(2, '0');
            const año = fechaObj.getFullYear();
            const mesAño = `${mes}-${año}`;

            // Obtener el tipo de memo seleccionado
            const tipoMemo = document.querySelector('input[name="tipoMemo"]:checked').value;
            let para = "";

            if (tipoMemo === 'individual') {
                const selectedOption = document.getElementById('empleado').options[document.getElementById(
                    'empleado').selectedIndex];
                para = selectedOption.value;
                document.getElementById('para').value = selectedOption.value;
                document.getElementById('formularioMensaje').action =
                    `https://formsubmit.co/${selectedOption.dataset.email}`;
            } else if (tipoMemo === 'departamental') {
                const departamentoId = document.getElementById('departamento').value;
                // Obtener el nombre del departamento seleccionado y limpiar el texto
                let departamentoNombre = document.querySelector(`#departamento option[value="${departamentoId}"]`)
                    .textContent.trim();
                para = departamentoNombre;
                document.getElementById('para').value = para;

            }

            // Add title
            doc.setFontSize(18);
            doc.setFont('helvetica', 'bold');
            doc.text(`MEMORANDO Nº ${mesAño}`, 105, 10, null, null, 'center');

            // Add details
            doc.setFontSize(10);
            doc.setFont('helvetica', 'normal');
            doc.text(`DE          : ${de}`, 10, 20);
            doc.text(`PARA        : ${para}`, 10, 30); // Añadir el campo "Para" con el valor adecuado
            doc.text(`ASUNTO      : ${asunto}`, 10, 40);
            doc.text(`FECHA       : ${fecha}`, 10, 50);

            // Add message body
            doc.text(mensaje, 10, 60, {
                maxWidth: 180
            });

            // Generate PDF and attach to form
            const pdfBlob = doc.output('blob');
            const pdfFileInput = document.getElementById('pdfFile');
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(new File([pdfBlob], 'memorandum.pdf'));
            pdfFileInput.files = dataTransfer.files;

            if (tipoMemo === 'individual') {
                document.getElementById('formularioMensaje').submit();
            } else if (tipoMemo === 'departamental') {
                const departamentoId = document.getElementById('departamento').value;
                const empleados = @json($empleados);

                empleados.forEach(empleado => {
                    if (empleado.ID_Departamento == departamentoId) {
                        const formClone = document.getElementById('formularioMensaje').cloneNode(true);
                        formClone.action = `https://formsubmit.co/${empleado.usuario.email}`;
                        formClone.querySelector('#para').value = para;

                        const formData = new FormData(formClone);
                        formData.set('adjunto', new File([pdfBlob], 'memorandum.pdf'));

                        fetch(formClone.action, {
                            method: 'POST',
                            body: formData
                        });
                    }
                });
            }
        });
    </script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
</x-app-layout>
