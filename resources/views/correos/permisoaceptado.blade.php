<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permiso Aceptado</title>
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
            background-color: #ffffff;
            border: 1px solid #ddd;
            text-align: left;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
            border-radius: 5px;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            margin: 20px 0;
            background-color: #26c6da;
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
            margin-bottom: 20px;
        }

        .header {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="header">¡Tu Permiso Ha Sido Aceptado!</h1>
        <p>Hola, {{ $notifiable->name }}:</p>
        <p>Nos complace informarte que tu solicitud de permiso ha sido aceptada. A continuación, encontrarás los detalles del permiso aprobado:</p>
        <ul>
            <li>Fecha de inicio: {{ $permiso->fecha_inicio }}</li>
            <li>Fecha de finalización: {{ $permiso->fecha_fin }}</li>
            <li>Motivo: {{ $permiso->motivo }}</li>
        </ul>
        <p>Agradecemos tu cooperación y esperamos que disfrutes de tu tiempo libre. Si tienes alguna pregunta o necesitas más información, no dudes en contactarnos.</p>
        <a href="http://137.184.179.201/" class="button">Ver Detalles del Permiso</a>
        <p class="footer">¡Saludos cordiales,</p>
        @php
            $user = App\Models\User::find($permiso->ID_Usuario);
        @endphp
        <p class="footer">{{ $user->name }}</p>
        <p class="footer">{{ $user->empleado->cargo->nombre }}</p>
        <p class="footer">[Nombre de la Empresa]</p>
    </div>
</body>

</html>
