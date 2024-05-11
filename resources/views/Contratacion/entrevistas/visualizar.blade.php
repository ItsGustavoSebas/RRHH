<x-app-layout>
    <!-- component -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificación de Correo</title>
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
            margin-top: 80px;
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
}

        .header {
            font-weight: bold;
            /* Hace el título en negritas */
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="header">¡Has sido seleccionado para la etapa de entrevista!</h1>
        @php
            $postulante = App\Models\User::find($entrevista->ID_Postulante);
        @endphp
        <p>Hola, {{ $postulante->name }}:</p>
        <p>Es un placer comunicarte que después de revisar cuidadosamente tu aplicación para el puesto de [Nombre del
            Puesto], nos complace informarte que has sido seleccionado/a para avanzar en nuestro proceso de selección y
            participar en una entrevista.</p>
        <p>La entrevista se llevará a cabo en:</p>
        <ul>
            <li>Fecha: {{ $entrevista->fecha_inicio }}</li>
            <li>Hora: {{ $entrevista->hora }}</li>
            <li>Lugar: Calle Libertad Nro 24</li>
        </ul>
        <p>Durante la entrevista, tendrás la oportunidad de discutir más a fondo tus habilidades, experiencia y
            expectativas con nuestro equipo de reclutamiento. También tendrás la oportunidad de aprender más sobre
            nuestra empresa y el rol específico para el cual estás siendo considerado/a.</p>
        <p>Para confirmar tu disponibilidad para la entrevista, por favor presiona en el botón de abajo</p>
        <p>{{ $entrevista->detalles }}</p>
        <p>Estamos emocionados de conocerte y discutir cómo puedes contribuir al equipo en [Nombre de la Empresa].
            ¡Esperamos con ansias nuestra reunión!</p>
        <a href="http://127.0.0.1:8000/" class="button">Confirmar</a>
        <p class="footer">¡Saludos cordiales,</p>
        @php
            $user = App\Models\User::find($entrevista->ID_Usuario);
        @endphp
        <p class="footer">{{ $user->name }}</p>
        <p class="footer">{{ $user->empleado->cargo->nombre }}</p>
        <p class="footer">[Nombre de la Empresa]</p>
    </div>

    <script>
        // Script para redirigir al inicio de la página cuando se hace clic en el botón "Más información"
        document.querySelector('.button').addEventListener('click', function() {
            window.location.href = 'http://127.0.0.1:8000/';
        });
    </script>

</body>

</html>

</x-app-layout>