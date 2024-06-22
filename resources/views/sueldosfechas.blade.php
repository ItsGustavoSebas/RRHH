<!DOCTYPE html>
<html>
<head>
    <title>Sueldos</title>
    <!-- Incluye CSS y JS de Bootstrap para el modal -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <h2>Sueldos</h2>

    <!-- Modal para ingresar fechas -->
    <div class="modal" id="fechaModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('sueldos.inicio') }}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Ingresar Fechas</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="fecha_inicio">Fecha Inicio:</label>
                            <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
                        </div>
                        <div class="form-group">
                            <label for="fecha_fin">Fecha Fin:</label>
                            <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Aquí puedes mostrar los datos de sueldos calculados si existen -->
    @if(isset($empleadosCalculados))
        <!-- Código para mostrar los empleados calculados -->
    @endif

</div>

<script>
    $(document).ready(function(){
        $("#fechaModal").modal('show');
    });
</script>

</body>
</html>
