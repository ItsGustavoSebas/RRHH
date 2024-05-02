<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

</head>
<style>
    table {
        width: 100%;
        border-collapse: collapse;
        margin: 0 auto;
    }

    th,
    td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
    }
</style>

<body>
    <div style="text-align: center;">
        <h1>Reporte de Postulantes</h1>        
        <p>Este reporte contiene información sobre los postulantes.</p>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Fecha de nacimiento</th>
                <th>Nacionalidad</th>
                <th>Habilidades</th>
                <th>Fuente de contratación</th>
                <th>Puesto elegido</th>
                <th>Idioma secundario</th>
            </tr>
        </thead>
        <tbody>
            @if (!is_null($postulante))
                @foreach ($postulante as $postulanteU)
                    <tr>
                        <td>{{ $postulanteU->ID_Usuario }}</td>
                        <td>{{ $postulanteU->fecha_de_nacimiento }}</td>
                        <td>{{ $postulanteU->nacionalidad }}</td>
                        <td>{{ $postulanteU->habilidades }}</td>
                        <td>{{ $postulanteU->ID_Fuente_De_Contratacion }}</td>
                        <td>{{ $postulanteU->ID_Puesto_Disponible }}</td>
                        <td>{{ $postulanteU->ID_Idioma }}</td>
                    </tr>
                @endforeach
            @else
            @endif
        </tbody>
    </table>
</body>

</html>
