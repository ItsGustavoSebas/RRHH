<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Sueldos de Empleados</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 5px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2>Sueldos de Empleados</h2>
    <table>
        <thead>
            <tr>
                <th>Empleado</th>
                <th>Fecha de Nacimiento</th>
                <th>Cargo</th>
                <th>Fecha de Ingreso</th>
                <th>Días Trabajados</th>
                <th>Horas/Día pagadas</th>
                <th>Haber Básico</th>
                <th>Bono Antigüedad</th>
                <th>Horas Extras</th>
                <th>Pago por Horas Extras</th>
                <th>Dominical y Feriado</th>
                <th>Pago Dominical y Feriado</th>
                <th>Total Ganado</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($empleadosCalculados as $empleado)
                <tr>
                    <td>{{ $empleado['empleado']->usuario->name }}</td>
                    <td>{{ $empleado['empleado']->fechanac }}</td>
                    <td>{{ $empleado['empleado']->cargo->nombre }}</td>
                    <td>{{ $empleado['empleado']->created_at }}</td>
                    <td>{{ $empleado['dias_trabajados'] }}</td>
                    <td>{{ $empleado['empleado']->sueldo->horas_diarias }}</td>
                    <td>{{ number_format($empleado['haber_basico'], 2) }}</td>
                    <td>{{ number_format($empleado['bono_antiguedad'], 2) }}</td>
                    <td>{{ number_format($empleado['horas_extras'], 2) }}</td>
                    <td>{{ number_format($empleado['pago_por_horas_extras'], 2) }}</td>
                    <td>{{ $empleado['dominical_feriado'] }}</td>
                    <td>{{ number_format($empleado['pago_dominical_feriado'], 2) }}</td>
                    <td>{{ number_format($empleado['total_ganado'], 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
