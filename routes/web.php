<?php

use App\Exports\EmpleadoPersonalizadoExport;
use App\Http\Controllers\AsistenciaController;
use App\Http\Controllers\BitacoraController;
use App\Http\Controllers\EducacionController;
use App\Http\Controllers\ExperienciaController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\DetalleBitacoraController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\EntrevistaController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\InformacionPersonalController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\Puesto_DisponibleController;
use App\Http\Controllers\PostulanteController;
use App\Http\Controllers\Pre_ContratoController;
use App\Http\Controllers\ReconocimientoController;
use App\Http\Controllers\ReferenciaController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\ActividadController;
use App\Http\Controllers\Llamada_De_AtencionController;
use App\Http\Controllers\MemorandumController;
use App\Models\Educacion;
use App\Models\Postulante;
use App\Models\Reconocimiento;
use App\Models\Departamento;
use App\Models\Puesto_Disponible;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/time', function () {
    return now();
});

Route::get('/', function () {
    return view('welcome');
});
Route::get('/puestos', function () {
    $puesto_disponibles = Puesto_Disponible::where('disponible', '>', 0)->get();
    return view('puestos-disponible', compact('puesto_disponibles'));
})->name('puestos');
Route::get('/Contrato/PDF/{id}', [Pre_ContratoController::class, 'generarContratoPDF'])->name('generarContratoPDF');
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard/{opcional?}', function ($opcional = null) {
        return view('dashboard', compact('opcional'));
    })->name('dashboard');

    //POSTULANTE CONTROLLER
    Route::get('/postulantes/inicio', [PostulanteController::class, 'inicio'])->name('postulantes.inicio');
    // Route::get('/docentes/crear', [PostulanteController::class, 'crear'])->name('docentes.crear');
    Route::get('/postulantes/editar/{id}', [PostulanteController::class, 'editar'])->name('postulantes.editar');
    Route::post('/postulantes/actualizar/{id}', [PostulanteController::class, 'actualizar'])->name('postulantes.actualizar');
    Route::post('/postulantes/eliminar/{id}', [PostulanteController::class, 'eliminar'])->name('postulantes.eliminar');
    //Route::post('/docentes/guardar', [PostulanteController::class, 'guardar'])->name('docentes.guardar');

    //ROLES

    Route::get('/roles/inicio', [RoleController::class, 'inicio'])->name('roles.inicio');
    Route::get('/roles/crear', [RoleController::class, 'crear'])->name('roles.crear');
    Route::post('/roles/guardar', [RoleController::class, 'guardar'])->name('roles.guardar');
    Route::get('/roles/editar/{id}', [RoleController::class, 'editar'])->name('roles.editar');
    Route::post('/roles/actualizar/{id}', [RoleController::class, 'actualizar'])->name('roles.actualizar');
    Route::post('/roles/eliminar/{id}', [RoleController::class, 'eliminar'])->name('roles.eliminar');


    Route::get('/completado', function () {
        return view('Contratacion.completado');
    })->name('completado');

    //DEPARTAMENTOS
    Route::get('/departamentos/inicio', [DepartamentoController::class, 'inicio'])->name('departamentos.inicio');
    Route::get('/departamentos/crear', [DepartamentoController::class, 'crear'])->name('departamentos.crear');
    Route::post('/departamentos/guardar', [DepartamentoController::class, 'guardar'])->name('departamentos.guardar');
    Route::get('/departamentos/editar/{id}', [DepartamentoController::class, 'editar'])->name('departamentos.editar');
    Route::post('/departamentos/actualizar/{id}', [DepartamentoController::class, 'actualizar'])->name('departamentos.actualizar');
    Route::post('/departamentos/eliminar/{id}', [DepartamentoController::class, 'eliminar'])->name('departamentos.eliminar');

    //puesto_disponibles
    Route::get('puesto_disponibles/inicio', [Puesto_DisponibleController::class, 'inicio'])->name('puesto_disponibles.inicio');
    Route::get('puesto_disponibles/crear', [Puesto_DisponibleController::class, 'crear'])->name('puesto_disponibles.crear');
    Route::post('puesto_disponibles/guardar', [Puesto_DisponibleController::class, 'guardar'])->name('puesto_disponibles.guardar');
    Route::get('puesto_disponibles/editar/{id}', [Puesto_DisponibleController::class, 'editar'])->name('puesto_disponibles.editar');
    Route::post('puesto_disponibles/actualizar/{id}', [Puesto_DisponibleController::class, 'actualizar'])->name('puesto_disponibles.actualizar');
    Route::post('puesto_disponibles/eliminar/{id}', [Puesto_DisponibleController::class, 'eliminar'])->name('puesto_disponibles.eliminar');
    Route::get('puesto_disponibles/disponibles', [Puesto_DisponibleController::class, 'disponibles'])->name('puesto_disponibles.disponibles');
    Route::get('puesto_disponibles/postularse/{idpuesto}', [Puesto_DisponibleController::class, 'postularse'])->name('puesto_disponibles.postularse');

    //CARGOS
    Route::get('/cargos/inicio', [CargoController::class, 'inicio'])->name('cargos.inicio');
    Route::get('/cargos/crear', [CargoController::class, 'crear'])->name('cargos.crear');
    Route::post('/cargos/guardar', [CargoController::class, 'guardar'])->name('cargos.guardar');
    Route::get('/cargos/editar/{id}', [CargoController::class, 'editar'])->name('cargos.editar');
    Route::post('/cargos/actualizar/{id}', [CargoController::class, 'actualizar'])->name('cargos.actualizar');
    Route::post('/cargos/eliminar/{id}', [CargoController::class, 'eliminar'])->name('cargos.eliminar');

    //EMPLEADOS
    Route::get('/usuarios/empleados/crear', [EmpleadoController::class, 'crear'])->name('empleados.crear');
    Route::post('/usuarios/empleados/guardar', [EmpleadoController::class, 'guardar'])->name('empleados.guardar');
    Route::get('/usuarios/empleados/inicio', [EmpleadoController::class, 'inicio'])->name('empleados.inicio');
    Route::get('/usuarios/empleados/editar/{id}', [EmpleadoController::class, 'editar'])->name('empleados.editar');
    Route::post('/usuarios/empleados/actualizar/{id}', [EmpleadoController::class, 'actualizar'])->name('empleados.actualizar');
    Route::post('/usuarios/empleados/eliminar/{id}', [EmpleadoController::class, 'eliminar'])->name('empleados.eliminar');

    Route::get('/usuarios/empleados/inicioH/{id}', [EmpleadoController::class, 'inicioH'])->name('empleados.inicioH');
    Route::get('/usuarios/empleados/asignarHorario/{id}', [EmpleadoController::class, 'asignarHorario'])->name('empleados.asignarHorario');
    Route::post('/usuarios/empleados/guardarHorario/{id}', [EmpleadoController::class, 'guardarHorario'])->name('empleados.guardarHorario');
    Route::get('/usuarios/empleados/editarH/{id}', [EmpleadoController::class, 'editarH'])->name('empleados.editarH');
    Route::post('/usuarios/empleados/actualizarH/{id}', [EmpleadoController::class, 'actualizarH'])->name('empleados.actualizarH');
    Route::post('/usuarios/empleados/eliminarH/{id}', [EmpleadoController::class, 'eliminarH'])->name('empleados.eliminarH');




    //INFORMACIONPERSONAL
    Route::get('/informacionpersonal/inicio/{id}', [InformacionPersonalController::class, 'inicio'])->name('informacionpersonal.inicio');
    Route::post('/informacionpersonal/actualizarD/{id}', [InformacionPersonalController::class, 'actualizarDepartamento'])->name('informacionpersonal.actualizar.departamento');
    Route::post('/informacionpersonal/actualizarC/{id}', [InformacionPersonalController::class, 'actualizarCargo'])->name('informacionpersonal.actualizar.cargo');
    Route::post('/informacionpersonal/actualizarT/{id}', [InformacionPersonalController::class, 'actualizarTelefono'])->name('informacionpersonal.actualizar.telefono');



    //EDUCACIONES CONTROLLER
    Route::get('/educaciones/rinicio', [EducacionController::class, 'rinicio'])->name('educaciones.rinicio');
    Route::get('/educaciones/crear', [EducacionController::class, 'crear'])->name('educaciones.crear');
    Route::get('/educaciones/crearSIG', [EducacionController::class, 'crearSIG'])->name('educaciones.crearSIG');
    Route::get('/educaciones/editar/{id}', [EducacionController::class, 'editar'])->name('educaciones.editar');
    Route::post('/educaciones/actualizar/{id}', [EducacionController::class, 'actualizar'])->name('educaciones.actualizar');
    Route::post('/educaciones/eliminar/{id}', [EducacionController::class, 'eliminar'])->name('educaciones.eliminar');
    Route::post('/educaciones/guardar', [EducacionController::class, 'guardar'])->name('educaciones.guardar');
    Route::post('/educaciones/guardarSIG', [EducacionController::class, 'guardarSIG'])->name('educaciones.guardarSIG');

    //POSTULANTES CONTROLLER
    Route::get('/postulantes/rinicio', [PostulanteController::class, 'rinicio'])->name('postulantes.rinicio');
    Route::get('/postulantes/editar/{id}', [PostulanteController::class, 'editar'])->name('postulantes.editar');
    Route::get('/postulantes/editarGES/{id}', [PostulanteController::class, 'editarGES'])->name('postulantes.editarGES');
    Route::post('/postulantes/actualizar/{id}', [PostulanteController::class, 'actualizar'])->name('postulantes.actualizar');
    Route::post('/postulantes/actualizarGES/{id}', [PostulanteController::class, 'actualizarGES'])->name('postulantes.actualizarGES');
    Route::get('/postulantes/postularse', [PostulanteController::class, 'postularse'])->name('postulantes.postularse');
    Route::get('/postulantes/inicio', [PostulanteController::class, 'inicio'])->name('postulantes.inicio');
    Route::post('/postulantes/rechazar/{id}', [PostulanteController::class, 'rechazar'])->name('postulantes.rechazar');
    Route::post('/postulantes/proceso/{id}', [PostulanteController::class, 'proceso'])->name('postulantes.proceso');

    //Postulante evaluación CONTROLLER
    Route::post('/postulantes/evaluar', [PostulanteController::class, 'evaluar'])->name('postulantes.evaluar');
    Route::get('/postulantes/evaluarInicio/{id}', [PostulanteController::class, 'evaluarInicio'])->name('postulantes.evaluarInicio');
    Route::get('/postulantes/evaluacionIdioma/{id}', [PostulanteController::class, 'evaluacionIdioma'])->name('postulantes.evaluacionIdioma');
    Route::get('/postulantes/evaluacionEducacion/{id}', [PostulanteController::class, 'evaluacionEducacion'])->name('postulantes.evaluacionEducacion');
    Route::get('/postulantes/evaluacionReconocimiento/{id}', [PostulanteController::class, 'evaluacionReconocimiento'])->name('postulantes.evaluacionReconocimiento');
    Route::get('/postulantes/evaluacionReferencia/{id}', [PostulanteController::class, 'evaluacionReferencia'])->name('postulantes.evaluacionReferencia');
    Route::get('/postulantes/evaluacionExperiencia/{id}', [PostulanteController::class, 'evaluacionExperiencia'])->name('postulantes.evaluacionExperiencia');
    Route::post('/postulantes/actualizarEvaluacionIdioma/{id}', [PostulanteController::class, 'actualizar'])->name('postulantes.actualizarEvaluacionIdioma');
    Route::post('/postulantes/editarEvaluacionEducacion/{id}', [PostulanteController::class, 'editarEvaluacionEducacion'])->name('postulantes.editarEvaluacionEducacion');
    Route::post('/postulantes/actualizarEvaluacionReconocimiento/{id}', [PostulanteController::class, 'actualizar'])->name('postulantes.actualizarEvaluacionReconocimiento');
    Route::post('/postulantes/actualizarEvaluacionExperiencia/{id}', [PostulanteController::class, 'actualizar'])->name('postulantes.actualizarEvaluacionExperiencia');



    //Entrevistas postulante CONTROLLER
    Route::get('/entrevistas/crear/{id}', [EntrevistaController::class, 'crear'])->name('entrevistas.crear');
    Route::post('/entrevistas/guardar/{id}', [EntrevistaController::class, 'guardar'])->name('entrevistas.guardar');
    Route::get('/entrevistas/inicio', [EntrevistaController::class, 'inicio'])->name('entrevistas.inicio');
    Route::get('/entrevistas/editar/{id}', [EntrevistaController::class, 'editar'])->name('entrevistas.editar');
    Route::post('/entrevistas/actualizar/{id}', [EntrevistaController::class, 'actualizar'])->name('entrevistas.actualizar');
    Route::post('/entrevistas/eliminar/{id}', [EntrevistaController::class, 'eliminar'])->name('entrevistas.eliminar');
    Route::get('/entrevistas/visualizar/{id}', [EntrevistaController::class, 'visualizar'])->name('entrevistas.visualizar');





    //RECONOCIMIENTOS CONTROLLER
    Route::get('/reconocimientos/rinicio', [ReconocimientoController::class, 'rinicio'])->name('reconocimientos.rinicio');
    Route::get('/reconocimientos/crear', [ReconocimientoController::class, 'crear'])->name('reconocimientos.crear');
    Route::get('/reconocimientos/crearSIG', [ReconocimientoController::class, 'crearSIG'])->name('reconocimientos.crearSIG');
    Route::get('/reconocimientos/editar/{id}', [ReconocimientoController::class, 'editar'])->name('reconocimientos.editar');
    Route::post('/reconocimientos/actualizar/{id}', [ReconocimientoController::class, 'actualizar'])->name('reconocimientos.actualizar');
    Route::post('/reconocimientos/eliminar/{id}', [ReconocimientoController::class, 'eliminar'])->name('reconocimientos.eliminar');
    Route::post('/reconocimientos/guardar', [ReconocimientoController::class, 'guardar'])->name('reconocimientos.guardar');
    Route::post('/reconocimientos/guardarSIG', [ReconocimientoController::class, 'guardarSIG'])->name('reconocimientos.guardarSIG');


    //EXPERIENCIAS CONTROLLER
    Route::get('/experiencias/rinicio', [ExperienciaController::class, 'rinicio'])->name('experiencias.rinicio');
    Route::get('/experiencias/crear', [ExperienciaController::class, 'crear'])->name('experiencias.crear');
    Route::get('/experiencias/crearSIG', [ExperienciaController::class, 'crearSIG'])->name('experiencias.crearSIG');
    Route::get('/experiencias/editar/{id}', [ExperienciaController::class, 'editar'])->name('experiencias.editar');
    Route::post('/experiencias/actualizar/{id}', [ExperienciaController::class, 'actualizar'])->name('experiencias.actualizar');
    Route::post('/experiencias/eliminar/{id}', [ExperienciaController::class, 'eliminar'])->name('experiencias.eliminar');
    Route::post('/experiencias/guardar', [ExperienciaController::class, 'guardar'])->name('experiencias.guardar');
    Route::post('/experiencias/guardarSIG', [ExperienciaController::class, 'guardarSIG'])->name('experiencias.guardarSIG');


    //REFERENCIAS CONTROLLER
    Route::get('/referencias/rinicio', [ReferenciaController::class, 'rinicio'])->name('referencias.rinicio');
    Route::get('/referencias/crear', [ReferenciaController::class, 'crear'])->name('referencias.crear');
    Route::get('/referencias/crearSIG', [ReferenciaController::class, 'crearSIG'])->name('referencias.crearSIG');
    Route::get('/referencias/editar/{id}', [ReferenciaController::class, 'editar'])->name('referencias.editar');
    Route::post('/referencias/actualizar/{id}', [ReferenciaController::class, 'actualizar'])->name('referencias.actualizar');
    Route::post('/referencias/eliminar/{id}', [ReferenciaController::class, 'eliminar'])->name('referencias.eliminar');
    Route::post('/referencias/guardar', [ReferenciaController::class, 'guardar'])->name('referencias.guardar');
    Route::post('/referencias/guardarSIG', [ReferenciaController::class, 'guardarSIG'])->name('referencias.guardarSIG');

    //Bitacora
    Route::get('/bitacoras/inicio/{id}', [BitacoraController::class, 'inicio'])->name('bitacoras.inicio');
    Route::get('/bitacoras/rinicio', [BitacoraController::class, 'rinicio'])->name('bitacoras.rinicio');
    Route::get('/bitacoras/PDF', [BitacoraController::class, 'generarBitacoraPDF'])->name('generarBitacoraPDF');
    Route::get('/bitacoras/PDF/{id}', [BitacoraController::class, 'generarBitacoraPDF_usuario'])->name('generarBitacoraPDF_usuario');

    //DetalleBitacora
    Route::get('/detbitacoras/inicio/{id}', [DetalleBitacoraController::class, 'inicio'])->name('detbitacoras.inicio');
    Route::get('/detbitacoras/PDF/{id}', [DetalleBitacoraController::class, 'generarDetalleBitacoraPDF'])->name('generarDetalleBitacoraPDF');

    //Reportes
    Route::get('/reportes/inicio', [ReporteController::class, 'inicio'])->name('reportes.inicio');
    Route::post('/reportes/empleados/personalizado', [ReporteController::class, 'reporteempleadopersonalizado'])->name('reportes.empleado');
    Route::post('/reportes/departamentos/empleados/personalizado', [ReporteController::class, 'reportedepartamentoempleadopersonalizado'])->name('reportes.departamento.empleado');
    Route::post('/reportes/postulantes/personalizado', [ReporteController::class, 'reportepostulantepersonalizado'])->name('reportes.postulante');
    Route::get('/reportes/postulantes/excel', [ReporteController::class, 'excelpostulante'])->name('excelpostulante');
    Route::get('/reportes/postulantes/csv', [ReporteController::class, 'csvpostulante'])->name('csvpostulante');
    Route::get('/reportes/postulantes/pdf', [ReporteController::class, 'pdfpostulante'])->name('pdfpostulante');
    Route::get('/reportes/postulantes/html', [ReporteController::class, 'htmlpostulante'])->name('htmlpostulante');
    Route::get('/reportes/empleados/excel', [ReporteController::class, 'excelempleado'])->name('excelempleado');
    Route::get('/reportes/empleados/csv', [ReporteController::class, 'csvempleado'])->name('csvempleado');
    Route::get('/reportes/empleados/pdf', [ReporteController::class, 'pdfempleado'])->name('pdfempleado');
    Route::get('/reportes/empleados/html', [ReporteController::class, 'htmlempleado'])->name('htmlempleado');

    Route::post('/marcar-notificacion-leida/{id}', [EntrevistaController::class, 'marcarLeida'])->name('marcar_notificacion_leida');

    //HORARIOS
    Route::get('/horarios/inicio', [HorarioController::class, 'inicio'])->name('horarios.inicio');
    Route::get('/horarios/crear', [HorarioController::class, 'crear'])->name('horarios.crear');
    Route::post('/horarios/guardar', [HorarioController::class, 'guardar'])->name('horarios.guardar');
    Route::get('/horarios/editar/{id}', [HorarioController::class, 'editar'])->name('horarios.editar');
    Route::post('/horarios/actualizar/{id}', [HorarioController::class, 'actualizar'])->name('horarios.actualizar');
    Route::post('/horarios/eliminar/{id}', [HorarioController::class, 'eliminar'])->name('horarios.eliminar');


    Route::get('/educaciones/rinicio', [EducacionController::class, 'rinicio'])->name('educaciones.rinicio');
    Route::get('/educaciones/crear', [EducacionController::class, 'crear'])->name('educaciones.crear');
    Route::get('/educaciones/crearSIG', [EducacionController::class, 'crearSIG'])->name('educaciones.crearSIG');
    Route::get('/educaciones/editar/{id}', [EducacionController::class, 'editar'])->name('educaciones.editar');
    Route::post('/educaciones/actualizar/{id}', [EducacionController::class, 'actualizar'])->name('educaciones.actualizar');
    Route::post('/educaciones/eliminar/{id}', [EducacionController::class, 'eliminar'])->name('educaciones.eliminar');
    Route::post('/educaciones/guardar', [EducacionController::class, 'guardar'])->name('educaciones.guardar');
    Route::post('/educaciones/guardarSIG', [EducacionController::class, 'guardarSIG'])->name('educaciones.guardarSIG');

    //POSTULANTES CONTROLLER
    Route::get('/postulantes/rinicio', [PostulanteController::class, 'rinicio'])->name('postulantes.rinicio');
    Route::get('/postulantes/editar/{id}', [PostulanteController::class, 'editar'])->name('postulantes.editar');
    Route::get('/postulantes/editarGES/{id}', [PostulanteController::class, 'editarGES'])->name('postulantes.editarGES');
    Route::post('/postulantes/actualizar/{id}', [PostulanteController::class, 'actualizar'])->name('postulantes.actualizar');
    Route::post('/postulantes/actualizarGES/{id}', [PostulanteController::class, 'actualizarGES'])->name('postulantes.actualizarGES');
    Route::get('/postulantes/postularse', [PostulanteController::class, 'postularse'])->name('postulantes.postularse');
    Route::get('/postulantes/inicio', [PostulanteController::class, 'inicio'])->name('postulantes.inicio');
    Route::post('/postulantes/rechazar/{id}', [PostulanteController::class, 'rechazar'])->name('postulantes.rechazar');
    Route::post('/postulantes/proceso/{id}', [PostulanteController::class, 'proceso'])->name('postulantes.proceso');
    Route::get('postulantes/editarinfo/{id}', [PostulanteController::class, 'editarinfo'])->name('postulantes.editarinfo');
    Route::post('postulantes/actualizarinfo/{id}', [PostulanteController::class, 'actualizarinfo'])->name('postulantes.actualizarinfo');


    //Postulante evaluación CONTROLLER
    Route::post('/postulantes/evaluar', [PostulanteController::class, 'evaluar'])->name('postulantes.evaluar');
    Route::get('/postulantes/evaluarInicio/{id}', [PostulanteController::class, 'evaluarInicio'])->name('postulantes.evaluarInicio');
    Route::get('/postulantes/evaluacionIdioma/{id}', [PostulanteController::class, 'evaluacionIdioma'])->name('postulantes.evaluacionIdioma');
    Route::get('/postulantes/evaluacionEducacion/{id}', [PostulanteController::class, 'evaluacionEducacion'])->name('postulantes.evaluacionEducacion');
    Route::get('/postulantes/evaluacionReconocimiento/{id}', [PostulanteController::class, 'evaluacionReconocimiento'])->name('postulantes.evaluacionReconocimiento');
    Route::get('/postulantes/evaluacionReferencia/{id}', [PostulanteController::class, 'evaluacionReferencia'])->name('postulantes.evaluacionReferencia');
    Route::get('/postulantes/evaluacionExperiencia/{id}', [PostulanteController::class, 'evaluacionExperiencia'])->name('postulantes.evaluacionExperiencia');
    Route::post('/postulantes/actualizarEvaluacionIdioma/{id}', [PostulanteController::class, 'actualizar'])->name('postulantes.actualizarEvaluacionIdioma');
    Route::post('/postulantes/editarEvaluacionEducacion/{id}', [PostulanteController::class, 'editarEvaluacionEducacion'])->name('postulantes.editarEvaluacionEducacion');
    Route::post('/postulantes/actualizarEvaluacionReconocimiento/{id}', [PostulanteController::class, 'actualizar'])->name('postulantes.actualizarEvaluacionReconocimiento');
    Route::post('/postulantes/actualizarEvaluacionExperiencia/{id}', [PostulanteController::class, 'actualizar'])->name('postulantes.actualizarEvaluacionExperiencia');



    //Entrevistas postulante CONTROLLER
    Route::get('/entrevistas/crear/{id}', [EntrevistaController::class, 'crear'])->name('entrevistas.crear');
    Route::post('/entrevistas/guardar/{id}', [EntrevistaController::class, 'guardar'])->name('entrevistas.guardar');
    Route::get('/entrevistas/inicio', [EntrevistaController::class, 'inicio'])->name('entrevistas.inicio');
    Route::get('/entrevistas/editar/{id}', [EntrevistaController::class, 'editar'])->name('entrevistas.editar');
    Route::post('/entrevistas/actualizar/{id}', [EntrevistaController::class, 'actualizar'])->name('entrevistas.actualizar');
    Route::post('/entrevistas/eliminar/{id}', [EntrevistaController::class, 'eliminar'])->name('entrevistas.eliminar');
    Route::get('/entrevistas/visualizar/{id}', [EntrevistaController::class, 'visualizar'])->name('entrevistas.visualizar');
    Route::post('/entrevistas/puntuar/{id}', [EntrevistaController::class, 'puntuar'])->name('entrevistas.puntuar');

    //Pre contrato CONTROLLER
    Route::get('/precontratos/crear/{id}', [Pre_ContratoController::class, 'crear'])->name('precontratos.crear');
    Route::post('/precontratos/guardar/{id}', [Pre_ContratoController::class, 'guardar'])->name('precontratos.guardar');
    Route::get('/precontratos/inicio', [Pre_ContratoController::class, 'inicio'])->name('precontratos.inicio');
    Route::get('/precontratos/editar/{id}', [Pre_ContratoController::class, 'editar'])->name('precontratos.editar');
    Route::post('/precontratos/actualizar/{id}', [Pre_ContratoController::class, 'actualizar'])->name('precontratos.actualizar');



    //CONTRATO PDF






    //RECONOCIMIENTOS CONTROLLER
    Route::get('/reconocimientos/rinicio', [ReconocimientoController::class, 'rinicio'])->name('reconocimientos.rinicio');
    Route::get('/reconocimientos/crear', [ReconocimientoController::class, 'crear'])->name('reconocimientos.crear');
    Route::get('/reconocimientos/crearSIG', [ReconocimientoController::class, 'crearSIG'])->name('reconocimientos.crearSIG');
    Route::get('/reconocimientos/editar/{id}', [ReconocimientoController::class, 'editar'])->name('reconocimientos.editar');
    Route::post('/reconocimientos/actualizar/{id}', [ReconocimientoController::class, 'actualizar'])->name('reconocimientos.actualizar');
    Route::post('/reconocimientos/eliminar/{id}', [ReconocimientoController::class, 'eliminar'])->name('reconocimientos.eliminar');
    Route::post('/reconocimientos/guardar', [ReconocimientoController::class, 'guardar'])->name('reconocimientos.guardar');
    Route::post('/reconocimientos/guardarSIG', [ReconocimientoController::class, 'guardarSIG'])->name('reconocimientos.guardarSIG');


    //EXPERIENCIAS CONTROLLER
    Route::get('/experiencias/rinicio', [ExperienciaController::class, 'rinicio'])->name('experiencias.rinicio');
    Route::get('/experiencias/crear', [ExperienciaController::class, 'crear'])->name('experiencias.crear');
    Route::get('/experiencias/crearSIG', [ExperienciaController::class, 'crearSIG'])->name('experiencias.crearSIG');
    Route::get('/experiencias/editar/{id}', [ExperienciaController::class, 'editar'])->name('experiencias.editar');
    Route::post('/experiencias/actualizar/{id}', [ExperienciaController::class, 'actualizar'])->name('experiencias.actualizar');
    Route::post('/experiencias/eliminar/{id}', [ExperienciaController::class, 'eliminar'])->name('experiencias.eliminar');
    Route::post('/experiencias/guardar', [ExperienciaController::class, 'guardar'])->name('experiencias.guardar');
    Route::post('/experiencias/guardarSIG', [ExperienciaController::class, 'guardarSIG'])->name('experiencias.guardarSIG');


    //REFERENCIAS CONTROLLER
    Route::get('/referencias/rinicio', [ReferenciaController::class, 'rinicio'])->name('referencias.rinicio');
    Route::get('/referencias/crear', [ReferenciaController::class, 'crear'])->name('referencias.crear');
    Route::get('/referencias/crearSIG', [ReferenciaController::class, 'crearSIG'])->name('referencias.crearSIG');
    Route::get('/referencias/editar/{id}', [ReferenciaController::class, 'editar'])->name('referencias.editar');
    Route::post('/referencias/actualizar/{id}', [ReferenciaController::class, 'actualizar'])->name('referencias.actualizar');
    Route::post('/referencias/eliminar/{id}', [ReferenciaController::class, 'eliminar'])->name('referencias.eliminar');
    Route::post('/referencias/guardar', [ReferenciaController::class, 'guardar'])->name('referencias.guardar');
    Route::post('/referencias/guardarSIG', [ReferenciaController::class, 'guardarSIG'])->name('referencias.guardarSIG');

    //Bitacora
    Route::get('/bitacoras/inicio/{id}', [BitacoraController::class, 'inicio'])->name('bitacoras.inicio');
    Route::get('/bitacoras/rinicio', [BitacoraController::class, 'rinicio'])->name('bitacoras.rinicio');
    Route::get('/bitacoras/PDF', [BitacoraController::class, 'generarBitacoraPDF'])->name('generarBitacoraPDF');
    Route::get('/bitacoras/PDF/{id}', [BitacoraController::class, 'generarBitacoraPDF_usuario'])->name('generarBitacoraPDF_usuario');

    //DetalleBitacora
    Route::get('/detbitacoras/inicio/{id}', [DetalleBitacoraController::class, 'inicio'])->name('detbitacoras.inicio');
    Route::get('/detbitacoras/PDF/{id}', [DetalleBitacoraController::class, 'generarDetalleBitacoraPDF'])->name('generarDetalleBitacoraPDF');

    //Reportes
    Route::get('/reportes/inicio', [ReporteController::class, 'inicio'])->name('reportes.inicio');
    Route::post('/reportes/empleados/personalizado', [ReporteController::class, 'reporteempleadopersonalizado'])->name('reportes.empleado');
    Route::post('/reportes/departamentos/empleados/personalizado', [ReporteController::class, 'reportedepartamentoempleadopersonalizado'])->name('reportes.departamento.empleado');
    Route::post('/reportes/postulantes/personalizado', [ReporteController::class, 'reportepostulantepersonalizado'])->name('reportes.postulante');
    Route::get('/reportes/postulantes/excel', [ReporteController::class, 'excelpostulante'])->name('excelpostulante');
    Route::get('/reportes/postulantes/csv', [ReporteController::class, 'csvpostulante'])->name('csvpostulante');
    Route::get('/reportes/postulantes/pdf', [ReporteController::class, 'pdfpostulante'])->name('pdfpostulante');
    Route::get('/reportes/postulantes/html', [ReporteController::class, 'htmlpostulante'])->name('htmlpostulante');
    Route::get('/reportes/empleados/excel', [ReporteController::class, 'excelempleado'])->name('excelempleado');
    Route::get('/reportes/empleados/csv', [ReporteController::class, 'csvempleado'])->name('csvempleado');
    Route::get('/reportes/empleados/pdf', [ReporteController::class, 'pdfempleado'])->name('pdfempleado');
    Route::get('/reportes/empleados/html', [ReporteController::class, 'htmlempleado'])->name('htmlempleado');

    Route::post('/marcar-notificacion-leida/{id}', [EntrevistaController::class, 'marcarLeida'])->name('marcar_notificacion_leida');

    // Rutas relacionadas con la gestión de permisos del personal
    Route::get('/permisos/solicitud', [PermisoController::class, 'create'])->name('permisos.solicitud');
    Route::post('/permisos/enviar-solicitud', [PermisoController::class, 'enviarSolicitud'])->name('permisos.enviar-solicitud');
    // Rutas relacionadas con el historial de permisos
    Route::get('/permisos/historial', [PermisoController::class, 'historial'])->name('permisos.historial');
    Route::post('/permisos/approve/{id}', [PermisoController::class, 'approve'])->name('permisos.approve');
    Route::post('/permisos/deny/{id}', [PermisoController::class, 'deny'])->name('permisos.deny');

    //ASISTENCIA
    Route::get('/asistencias/marcar/{id}', [AsistenciaController::class, 'marcar'])->name('asistencias.marcar');
    Route::post('/asistencias/guardarAsistencias/{idEmpleado}/{idDiaTrabajo}', [AsistenciaController::class, 'guardarAsistencias'])->name('asistencias.guardarAsistencias');
    Route::get('/asistencias/historial/{id}', [AsistenciaController::class, 'historial'])->name('asistencias.historial');
    Route::get('/asistencias/guardarAsistenciasAuto', [AsistenciaController::class, 'verificarFaltasAutomaticas'])->name('asistencias.verificarFaltasAutomaticas');


    Route::get('/educaciones/rinicio', [EducacionController::class, 'rinicio'])->name('educaciones.rinicio');
    Route::get('/educaciones/crear', [EducacionController::class, 'crear'])->name('educaciones.crear');
    Route::get('/educaciones/crearSIG', [EducacionController::class, 'crearSIG'])->name('educaciones.crearSIG');
    Route::get('/educaciones/editar/{id}', [EducacionController::class, 'editar'])->name('educaciones.editar');
    Route::post('/educaciones/actualizar/{id}', [EducacionController::class, 'actualizar'])->name('educaciones.actualizar');
    Route::post('/educaciones/eliminar/{id}', [EducacionController::class, 'eliminar'])->name('educaciones.eliminar');
    Route::post('/educaciones/guardar', [EducacionController::class, 'guardar'])->name('educaciones.guardar');
    Route::post('/educaciones/guardarSIG', [EducacionController::class, 'guardarSIG'])->name('educaciones.guardarSIG');

    //POSTULANTES CONTROLLER
    Route::get('/postulantes/rinicio', [PostulanteController::class, 'rinicio'])->name('postulantes.rinicio');
    Route::get('/postulantes/editar/{id}', [PostulanteController::class, 'editar'])->name('postulantes.editar');
    Route::get('/postulantes/editarGES/{id}', [PostulanteController::class, 'editarGES'])->name('postulantes.editarGES');
    Route::post('/postulantes/actualizar/{id}', [PostulanteController::class, 'actualizar'])->name('postulantes.actualizar');
    Route::post('/postulantes/actualizarGES/{id}', [PostulanteController::class, 'actualizarGES'])->name('postulantes.actualizarGES');
    Route::get('/postulantes/postularse', [PostulanteController::class, 'postularse'])->name('postulantes.postularse');
    Route::get('/postulantes/inicio', [PostulanteController::class, 'inicio'])->name('postulantes.inicio');
    Route::post('/postulantes/rechazar/{id}', [PostulanteController::class, 'rechazar'])->name('postulantes.rechazar');
    Route::post('/postulantes/proceso/{id}', [PostulanteController::class, 'proceso'])->name('postulantes.proceso');
    Route::get('postulantes/editarinfo/{id}', [PostulanteController::class, 'editarinfo'])->name('postulantes.editarinfo');
    Route::post('postulantes/actualizarinfo/{id}', [PostulanteController::class, 'actualizarinfo'])->name('postulantes.actualizarinfo');


    //Postulante evaluación CONTROLLER
    Route::post('/postulantes/evaluar', [PostulanteController::class, 'evaluar'])->name('postulantes.evaluar');
    Route::get('/postulantes/evaluarInicio/{id}', [PostulanteController::class, 'evaluarInicio'])->name('postulantes.evaluarInicio');
    Route::get('/postulantes/evaluacionIdioma/{id}', [PostulanteController::class, 'evaluacionIdioma'])->name('postulantes.evaluacionIdioma');
    Route::get('/postulantes/evaluacionEducacion/{id}', [PostulanteController::class, 'evaluacionEducacion'])->name('postulantes.evaluacionEducacion');
    Route::get('/postulantes/evaluacionReconocimiento/{id}', [PostulanteController::class, 'evaluacionReconocimiento'])->name('postulantes.evaluacionReconocimiento');
    Route::get('/postulantes/evaluacionReferencia/{id}', [PostulanteController::class, 'evaluacionReferencia'])->name('postulantes.evaluacionReferencia');
    Route::get('/postulantes/evaluacionExperiencia/{id}', [PostulanteController::class, 'evaluacionExperiencia'])->name('postulantes.evaluacionExperiencia');
    Route::post('/postulantes/actualizarEvaluacionIdioma/{id}', [PostulanteController::class, 'actualizar'])->name('postulantes.actualizarEvaluacionIdioma');
    Route::post('/postulantes/editarEvaluacionEducacion/{id}', [PostulanteController::class, 'editarEvaluacionEducacion'])->name('postulantes.editarEvaluacionEducacion');
    Route::post('/postulantes/actualizarEvaluacionReconocimiento/{id}', [PostulanteController::class, 'actualizar'])->name('postulantes.actualizarEvaluacionReconocimiento');
    Route::post('/postulantes/actualizarEvaluacionExperiencia/{id}', [PostulanteController::class, 'actualizar'])->name('postulantes.actualizarEvaluacionExperiencia');



    //Entrevistas postulante CONTROLLER
    Route::get('/entrevistas/crear/{id}', [EntrevistaController::class, 'crear'])->name('entrevistas.crear');
    Route::post('/entrevistas/guardar/{id}', [EntrevistaController::class, 'guardar'])->name('entrevistas.guardar');
    Route::get('/entrevistas/inicio', [EntrevistaController::class, 'inicio'])->name('entrevistas.inicio');
    Route::get('/entrevistas/editar/{id}', [EntrevistaController::class, 'editar'])->name('entrevistas.editar');
    Route::post('/entrevistas/actualizar/{id}', [EntrevistaController::class, 'actualizar'])->name('entrevistas.actualizar');
    Route::post('/entrevistas/eliminar/{id}', [EntrevistaController::class, 'eliminar'])->name('entrevistas.eliminar');
    Route::get('/entrevistas/visualizar/{id}', [EntrevistaController::class, 'visualizar'])->name('entrevistas.visualizar');
    Route::post('/entrevistas/puntuar/{id}', [EntrevistaController::class, 'puntuar'])->name('entrevistas.puntuar');

    //Pre contrato CONTROLLER
    Route::get('/precontratos/crear/{id}', [Pre_ContratoController::class, 'crear'])->name('precontratos.crear');
    Route::post('/precontratos/guardar/{id}', [Pre_ContratoController::class, 'guardar'])->name('precontratos.guardar');
    Route::get('/precontratos/inicio', [Pre_ContratoController::class, 'inicio'])->name('precontratos.inicio');
    Route::get('/precontratos/editar/{id}', [Pre_ContratoController::class, 'editar'])->name('precontratos.editar');
    Route::post('/precontratos/actualizar/{id}', [Pre_ContratoController::class, 'actualizar'])->name('precontratos.actualizar');
    Route::post('/precontratos/contratar/{id}', [Pre_ContratoController::class, 'contratar'])->name('precontratos.contratar');



    //CONTRATO PDF






    //RECONOCIMIENTOS CONTROLLER
    Route::get('/reconocimientos/rinicio', [ReconocimientoController::class, 'rinicio'])->name('reconocimientos.rinicio');
    Route::get('/reconocimientos/crear', [ReconocimientoController::class, 'crear'])->name('reconocimientos.crear');
    Route::get('/reconocimientos/crearSIG', [ReconocimientoController::class, 'crearSIG'])->name('reconocimientos.crearSIG');
    Route::get('/reconocimientos/editar/{id}', [ReconocimientoController::class, 'editar'])->name('reconocimientos.editar');
    Route::post('/reconocimientos/actualizar/{id}', [ReconocimientoController::class, 'actualizar'])->name('reconocimientos.actualizar');
    Route::post('/reconocimientos/eliminar/{id}', [ReconocimientoController::class, 'eliminar'])->name('reconocimientos.eliminar');
    Route::post('/reconocimientos/guardar', [ReconocimientoController::class, 'guardar'])->name('reconocimientos.guardar');
    Route::post('/reconocimientos/guardarSIG', [ReconocimientoController::class, 'guardarSIG'])->name('reconocimientos.guardarSIG');


    //EXPERIENCIAS CONTROLLER
    Route::get('/experiencias/rinicio', [ExperienciaController::class, 'rinicio'])->name('experiencias.rinicio');
    Route::get('/experiencias/crear', [ExperienciaController::class, 'crear'])->name('experiencias.crear');
    Route::get('/experiencias/crearSIG', [ExperienciaController::class, 'crearSIG'])->name('experiencias.crearSIG');
    Route::get('/experiencias/editar/{id}', [ExperienciaController::class, 'editar'])->name('experiencias.editar');
    Route::post('/experiencias/actualizar/{id}', [ExperienciaController::class, 'actualizar'])->name('experiencias.actualizar');
    Route::post('/experiencias/eliminar/{id}', [ExperienciaController::class, 'eliminar'])->name('experiencias.eliminar');
    Route::post('/experiencias/guardar', [ExperienciaController::class, 'guardar'])->name('experiencias.guardar');
    Route::post('/experiencias/guardarSIG', [ExperienciaController::class, 'guardarSIG'])->name('experiencias.guardarSIG');


    //REFERENCIAS CONTROLLER
    Route::get('/referencias/rinicio', [ReferenciaController::class, 'rinicio'])->name('referencias.rinicio');
    Route::get('/referencias/crear', [ReferenciaController::class, 'crear'])->name('referencias.crear');
    Route::get('/referencias/crearSIG', [ReferenciaController::class, 'crearSIG'])->name('referencias.crearSIG');
    Route::get('/referencias/editar/{id}', [ReferenciaController::class, 'editar'])->name('referencias.editar');
    Route::post('/referencias/actualizar/{id}', [ReferenciaController::class, 'actualizar'])->name('referencias.actualizar');
    Route::post('/referencias/eliminar/{id}', [ReferenciaController::class, 'eliminar'])->name('referencias.eliminar');
    Route::post('/referencias/guardar', [ReferenciaController::class, 'guardar'])->name('referencias.guardar');
    Route::post('/referencias/guardarSIG', [ReferenciaController::class, 'guardarSIG'])->name('referencias.guardarSIG');

    //Bitacora
    Route::get('/bitacoras/inicio/{id}', [BitacoraController::class, 'inicio'])->name('bitacoras.inicio');
    Route::get('/bitacoras/rinicio', [BitacoraController::class, 'rinicio'])->name('bitacoras.rinicio');
    Route::get('/bitacoras/PDF', [BitacoraController::class, 'generarBitacoraPDF'])->name('generarBitacoraPDF');
    Route::get('/bitacoras/PDF/{id}', [BitacoraController::class, 'generarBitacoraPDF_usuario'])->name('generarBitacoraPDF_usuario');

    //DetalleBitacora
    Route::get('/detbitacoras/inicio/{id}', [DetalleBitacoraController::class, 'inicio'])->name('detbitacoras.inicio');
    Route::get('/detbitacoras/PDF/{id}', [DetalleBitacoraController::class, 'generarDetalleBitacoraPDF'])->name('generarDetalleBitacoraPDF');

    //Reportes
    Route::get('/reportes/inicio', [ReporteController::class, 'inicio'])->name('reportes.inicio');
    Route::post('/reportes/empleados/personalizado', [ReporteController::class, 'reporteempleadopersonalizado'])->name('reportes.empleado');
    Route::post('/reportes/departamentos/empleados/personalizado', [ReporteController::class, 'reportedepartamentoempleadopersonalizado'])->name('reportes.departamento.empleado');
    Route::post('/reportes/postulantes/personalizado', [ReporteController::class, 'reportepostulantepersonalizado'])->name('reportes.postulante');
    Route::get('/reportes/postulantes/excel', [ReporteController::class, 'excelpostulante'])->name('excelpostulante');
    Route::get('/reportes/postulantes/csv', [ReporteController::class, 'csvpostulante'])->name('csvpostulante');
    Route::get('/reportes/postulantes/pdf', [ReporteController::class, 'pdfpostulante'])->name('pdfpostulante');
    Route::get('/reportes/postulantes/html', [ReporteController::class, 'htmlpostulante'])->name('htmlpostulante');
    Route::get('/reportes/empleados/excel', [ReporteController::class, 'excelempleado'])->name('excelempleado');
    Route::get('/reportes/empleados/csv', [ReporteController::class, 'csvempleado'])->name('csvempleado');
    Route::get('/reportes/empleados/pdf', [ReporteController::class, 'pdfempleado'])->name('pdfempleado');
    Route::get('/reportes/empleados/html', [ReporteController::class, 'htmlempleado'])->name('htmlempleado');

    Route::post('/marcar-notificacion-leida/{id}', [EntrevistaController::class, 'marcarComoLeida'])->name('notificaciones.marcarComoLeida');
    Route::post('/marcar-notificaciones-leida', [EntrevistaController::class, 'marcarTodasComoLeidas'])->name('notificaciones.marcarTodasComoLeidas');
    Route::get('/notificaciones/verTodas', [EntrevistaController::class, 'verTodas'])->name('notificaciones.verTodas');
    // Rutas relacionadas con la gestión de permisos del personal
    Route::get('/permisos/solicitud', [PermisoController::class, 'create'])->name('permisos.solicitud');
    Route::post('/permisos/enviar-solicitud', [PermisoController::class, 'enviarSolicitud'])->name('permisos.enviar-solicitud');
    // Rutas relacionadas con el historial de permisos
    Route::get('/permisos/historial', [PermisoController::class, 'historial'])->name('permisos.historial');
    Route::post('/permisos/approve/{id}', [PermisoController::class, 'approve'])->name('permisos.approve');
    Route::post('/permisos/deny/{id}', [PermisoController::class, 'deny'])->name('permisos.deny');




    //asistencias Evaluacion
    Route::get('/asistenciasEvaluacion/inicio', [AsistenciaController::class, 'evaluarInicio'])->name('asistencias.evaluarInicio');
    Route::post('/asistenciasEvaluacion/evaluar', [AsistenciaController::class, 'evaluar'])->name('asistencias.evaluar');
    Route::get('/asistenciasEvaluacion/editar/{id}', [AsistenciaController::class, 'editarEvaluacion'])->name('asistencias.editarEvaluacion');
    Route::post('/asistenciasEvaluacion/actualizar/{id}', [AsistenciaController::class, 'actualizarEvaluacion'])->name('asistencias.actualizarEvaluacion');
    Route::post('/asistenciasEvaluacion/eliminar/{id}', [AsistenciaController::class, 'eliminarEvaluacion'])->name('asistencias.eliminarEvaluacion');



    //COMUNICACION RRHH MENSAJES
    Route::get('/comunicacion/rinicio', [MessageController::class, 'rinicio'])->name('comunicacion.rinicio');
    Route::get('/comunicacion/crear', [MessageController::class, 'crear'])->name('comunicacion.crear');
    Route::post('/comunicacion/guardar', [MessageController::class, 'guardar'])->name('comunicacion.guardar');
    Route::post('/comunicacion/guardarCHAT', [MessageController::class, 'guardarCHAT'])->name('comunicacion.guardarCHAT');
    Route::get('/comunicacion/chatear/{idreceptor}', [MessageController::class, 'mostrar'])->name('comunicacion.mostrar');



    Route::get('/amemorandumAtencionGestion/inicio', [ActividadController::class, 'inicio'])->name('actividades.inicio');
    Route::get('/actividades/crear', [ActividadController::class, 'crear'])->name('actividades.crear');
    Route::post('/actividades/guardar', [ActividadController::class, 'guardar'])->name('actividades.guardar');
    Route::get('/actividades/editar/{id}', [ActividadController::class, 'editar'])->name('actividades.editar');
    Route::put('/actividades/actualizar/{id}', [ActividadController::class, 'actualizar'])->name('actividades.actualizar');
    Route::delete('/actividades/eliminar/{id}', [ActividadController::class, 'eliminar'])->name('actividades.eliminar');


    //memorandum
    Route::get('/memorandum/inicio', [MemorandumController::class, 'inicio'])->name('memorandum.inicio');

    //memorandum
    Route::view('/Memorandum', '2_Recursos_Humanos.comunicacionRRHH.memoInicio');
    Route::get('/memorandumAtencion/inicio', [Llamada_De_AtencionController::class, 'inicio'])->name('memorandumLlamada.inicio');
    Route::post('/memorandumAtencion/guardar', [Llamada_De_AtencionController::class, 'guardar'])->name('memorandumLlamada.guardar');
    Route::get('/memorandumAtencionGestion/inicio', [Llamada_De_AtencionController::class, 'inicioGes'])->name('memorandumLlamada.inicioGes');
    Route::get('/amemorandumAtencionGestion/editar/{id}', [Llamada_De_AtencionController::class, 'editar'])->name('memorandumLlamada.editar');
    Route::post('/amemorandumAtencionGestion/actualizar/{id}', [Llamada_De_AtencionController::class, 'actualizar'])->name('memorandumLlamada.actualizar');
    Route::post('/amemorandumAtencionGestion/eliminar/{id}', [Llamada_De_AtencionController::class, 'eliminar'])->name('memorandumLlamada.eliminar');

});
