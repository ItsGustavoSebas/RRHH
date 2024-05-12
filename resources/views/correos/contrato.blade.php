<!-- component -->
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Selección</title>
    <style>
        body {
            background-color: #f7f7f7;
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 30px auto;
            padding: 40px;
            /* Aumentado el padding para más espacio */
            background-color: #ffffff;
            border: 1px solid #ddd;
            text-align: left;
            /* Alinea el texto a la izquierda */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
            border-radius: 5px;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            margin: 20px 0;
            background-color: #26c6da;
            /* Color del botón */
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }

        .footer {
            font-size: 12px;
            color: #777777;
            text-align: center;
            margin-top: 20px;
            /* Añadido margen superior */
            margin-bottom: 20px;
            /* Añadido margen inferior */
        }

        .header {
            font-weight: bold;
            /* Hace el título en negritas */
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="header">¡Felicidades, has sido seleccionado para el puesto!</h1>
        <p>Hola, {{ $notifiable->name }}:</p>
        <p>Es un placer comunicarte que después de un riguroso proceso de selección, has sido seleccionado/a para el puesto
            de {{$contrato->postulante->puesto_disponible->nombre}} en nuestra empresa.</p>
        <p>Estamos impresionados por tu experiencia y habilidades, y creemos que serás un valioso miembro de nuestro
            equipo.</p>
        <p>Antes de proceder con el contrato formal, te invitamos a revisar los detalles del precontrato:</p>
        <a href="http://137.184.179.201/Contrato/PDF/{{$contrato->id}}" class="button">Ver Detalles del Precontrato</a>
        <p>Una vez que hayas revisado los detalles y estés listo/a para continuar, por favor ve a nuestras oficinas a firmar las bases del contrato:</p>
        <a href="http://137.184.179.201/" class="button">Mas detalles de la empresa</a>
        <p class="footer">¡Saludos cordiales,</p>
        @php
            $user = App\Models\User::find($contrato->ID_Usuario);
        @endphp
        <p class="footer">{{ $user->name }}</p>
        <p class="footer">{{ $user->empleado->cargo->nombre }}</p>
        <p class="footer">[Nombre de la Empresa]</p>
    </div>

</body>

</html>
