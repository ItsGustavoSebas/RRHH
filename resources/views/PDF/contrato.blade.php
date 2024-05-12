<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>RECIBO</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        .receipt-main {
            width: 80%;
            margin: 0 auto;
     
            border-radius: 10px;
            padding: 20px;
            
        }

        .receipt-title {
            text-align: center;
            text-transform: uppercase;
            font-size: 30px;
            font-weight: bold;
            margin: 0;
        }

        .receipt-subtitle {
            text-align: center;
            text-transform: uppercase;
            font-size: 20px;
            font-weight: bold;
            margin: 0;
        }

        .receipt-section {
            margin-top: 15px;
        }

        .receipt-label {
            font-weight: bold;
        }

        .receipt-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .receipt-table th,
        .receipt-table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        .receipt-table th {
            background-color: #f2f2f2;
        }

        .receipt-signatures-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .receipt-signature {
            width: 45%;
            border-top: 1px solid #000;
            padding-top: 10px;
        }

        .signature-info p {
            margin: 5px 0;
            font-size: 12px;
            line-height: 1.5;
        }

        .signature-line {
            margin-top: 5px;
            border-top: 1px solid #000;
        }

        .receipt-signature p {
            margin: 0;
            line-height: 1.5;
        }

        .receipt-signature p.receipt-line {
            border-bottom: 1px solid #000;
            margin-bottom: 10px;
            padding-bottom: 10px;
        }
    </style>
</head>

<body>

    <div class="receipt-main">

        <p class="receipt-title">CONTRATO INDIVIDUAL DE TRABAJO POR TIEMPO INDEFINIDO</p>
        <BR></BR>

        <div class="receipt-section">
            <span class="receipt-label">Entre: </span>
            <span>Recursos Humanos S.R.L.</span>
            <br>
            <span class="receipt-label">Representada por: </span>
            <span>{{ $pre_contrato->usuario->name }}</span>
            <br>
            <span class="receipt-label">Para: </span>
            <span>{{ $pre_contrato->postulante->usuario->name }}</span>
        </div>

        <BR>
            <BR></BR>
        </BR>
        <p class="receipt-subtitle">DECLARACIONES</p>
        <br>


        <div class="receipt-section">
            <span class="receipt-label">I. - DECLARA "EL EMPLEADOR": <br></span>
            <span>a) Ser una empresa legalmente constituida de acuerdo con las leyes de la República de Bolivia, con ubicación en: Avenue David Terrazas pasando 1 calle, casa Nro 3130, Reja Verde, Santa Cruz de la Sierra.<br> <br>
                  b) Estar representada por {{ $pre_contrato->usuario->name }}, quien actúa en su calidad de {{ optional($empleado->cargo)->nombre ?? 'N/A'  }}. <br> <br>
                  c) Tener la capacidad económica y legal para contratar trabajadores. <br> <br> <br></span>
        </div>

        <div class="receipt-section">
            <span class="receipt-label">II. - DECLARA "EL TRABAJADOR": <br></span>
            <span>a) Llamarse {{ $pre_contrato->postulante->usuario->name }}.<br> <br>
                  b) Con fecha de nacimiento el {{ $pre_contrato->postulante->fecha_de_nacimiento }}, de nacionalidad {{ $pre_contrato->postulante->nacionalidad }}. <br> <br>
                  c) Con domicilio en {{ $pre_contrato->postulante->usuario->direccion }}. <br> <br>
                  d) Identificación: 
                  <span style="margin-left: 0px;">• CI: {{ $pre_contrato->postulante->usuario->ci }}</span> <br>
                  <span style="margin-left: 120px;">• Estado civil: {{ $pre_contrato->estadocivil }}</span> <br>
                  <span style="margin-left: 120px;">• Teléfono: {{ $pre_contrato->postulante->usuario->telefono }} <br> <br>
                  e) Estar enterado de las condiciones laborales y aceptar el puesto, salario, y funciones descritas en este contrato. <br> <br></span>
                  
                  
                </span>
        </div>


        <br>

        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
    
        <p class="receipt-subtitle">CLAUSULAS</p>

     

        <div class="receipt-section">
            <span class="receipt-label">1ro. Objeto: </span>
            <span>Recursos Humanos S.R.L. contrata al trabajador {{ $pre_contrato->postulante->usuario->name }} para desempeñar en el departamento de {{ $pre_contrato->departamento->nombre }} con el cargo de {{ $pre_contrato->cargo->nombre }} en conformidad con las leyes laborales de Bolivia. <br> <br></span>
            
            <span class="receipt-label">2do. Duración:  </span>
            <span>Este contrato se establece por tiempo indeterminado a partir de la fecha de firma. <br> <br></span>
       
            
            <span class="receipt-label">3ra. Funciones: </span>
            <span>El trabajador desempeñará las funciones propias del puesto de {{ $pre_contrato->cargo->nombre }}, así como aquellas asignadas por sus superiores jerárquicos. <br> <br></span>

            <span class="receipt-label">4ta. Lugar de Trabajo:  </span>
            <span>El lugar de prestación de servicios será en las instalaciones de SALAR S.R.L., ubicadas en: Avenue David Terrazas pasando 1 calle, casa Nro 3130, Reja Verde, Santa Cruz de la Sierra. <br> <br></span>

            <span class="receipt-label">5ta. Jornada Laboral:  </span>
            <span>La jornada laboral será de 40 (8 horas por día) horas semanales, distribuidas de acuerdo con los horarios establecidos por la empresa. <br> <br></span>

            <span class="receipt-label">6ta. Salario:  </span>
            <span>El trabajador percibirá un salario mensual de 2500 bolivianos, pagadero conforme a las políticas de la empresa. <br> <br></span>

            <span class="receipt-label">7ma. Prestaciones:  </span>
            <span>El trabajador tendrá derecho a las prestaciones de ley, incluyendo aguinaldo, vacaciones, y demás beneficios establecidos en el Código de Trabajo de Bolivia y los reglamentos internos de la empresa. <br> <br></span>

            <span class="receipt-label">8va. Confidencialidad:  </span>
            <span>El trabajador se compromete a mantener la confidencialidad de la información privilegiada de la empresa Recursos Humanos S.R.L. <br> <br></span>

            <span class="receipt-label">9na. Rescisión:  </span>
            <span>Este contrato podrá ser rescindido por cualquiera de las partes mediante aviso escrito con 7 días de anticipación. <br> <br></span>

            <span class="receipt-label">Firma y Ratificación: </span>
            <span>Las partes declaran su conformidad con los términos y condiciones de este contrato, firmando el presente documento en dos ejemplares de igual tenor y valor. <br> <br></span>

            <span class="receipt-label">Recursos Humanos S.R.L.</span>
        

        </div>

        <br>

        <table style="width:100%;">
            <tr>
                <td style="width:50%; border:1px solid white;">
                    <div style="text-align:center;"><strong>POSTULANTE</strong></div>
                    <hr style="margin-top: 50px;">
                    <div style="text-align:center;"><strong>{{ $pre_contrato->postulante->usuario->name }}</strong></div>
                </td>
                <td style="width:50%; border:1px solid white;">
                    <div style="text-align:center;"><strong>Recursos Humanos S.R.L.</strong></div>
                    <hr style="margin-top: 50px; ">
                    <div style="text-align:center;"><strong>{{ $pre_contrato->usuario->name }}</strong></div>
                </td>
            </tr>
        </table>
        <br>

        <span class="receipt-label">Fecha de firma: ___/___/___</span>
        
 {{-- 
        <div class="receipt-section">
            <span class="receipt-label">Fecha:</span>
            <span>{{ $NotaVenta->fecha }}</span>
        </div>
        @if ($DetallesVentas && count($DetallesVentas) > 0)
            <div class="receipt-section">
                <span class="receipt-label">Productos en la Venta</span>
                <table class="receipt-table">
                    <thead>
                        <tr>
                            <th>Productos</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($DetallesVentas as $DetalleVenta)
                            <tr>
                                <td>{{ $DetalleVenta->producto->nombre }}</td>
                                <td>{{ $DetalleVenta->cantidad }}</td>
                                <td>{{ $DetalleVenta->precio }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
        @if ($NotaVenta->detalleCita && count($NotaVenta->detalleCita) > 0)
            <div class="receipt-section">
                <span class="receipt-label">Citas en la Venta</span>
                <table class="receipt-table">
                    <thead>
                        <tr>
                            <th>Descripción</th>
                            <th>Monto Total</th>
                            <th>Tipo de Cita</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($NotaVenta->detalleCita as $detalle)
                            <tr>
                                <td>{{ $detalle->descripcion }}</td>
                                <td>{{ $detalle->montoTotal }}</td>
                                <td>{{ $detalle->tipo }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
        <div class="receipt-signatures-container">
            <div class="receipt-signature">
                <div class="signature-info">
                    <p>AGRO - VETERINARIA "LA HACIENDA"</p>
                    <p>Telf.: 3541800 Cel.:72636967</p>
                    <p>Av.Piraí Nro.3160, Zona/Barrio Villa Rosario UV. 53 Maz. 7</p>
                    <p>Santa Cruz - Bolivia</p>
                </div>
                <div class="signature-line"></div>
            </div>

            <div class="receipt-signature">
                <div class="signature-info">
                    <p>Atendido por:</p>
                    <p>{{ $empleado->name }}</p>
                </div>
                <div class="signature-line"></div>
            </div>
        </div>
    </div> --}}

</body>

</html>
