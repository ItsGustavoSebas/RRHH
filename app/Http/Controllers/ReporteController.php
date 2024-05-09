<?php

namespace App\Http\Controllers;

use App\Exports\EmpleadoExport;
use App\Exports\EmpleadoPersonalizadoExport;
use App\Exports\PostulanteExport;
use App\Models\Departamento;
use App\Models\Empleado;
use App\Models\Fuente_De_Contratacion;
use App\Models\Idioma;
use App\Models\Postulante;
use App\Models\Puesto_Disponible;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as Format;
use Illuminate\Support\Facades\Schema;

class ReporteController extends Controller
{
    public function inicio()
    {
        $columnase = ['genero','estadocivil','fechanac','ID_Cargo','ID_Departamento'];
        $columnasu = ['id','name','email','ci','telefono','direccion'];
        $columnasp = ['fecha_de_nacimiento','nacionalidad','habilidades','puntos','ID_Fuente_De_Contratacion','ID_Puesto_Disponible','ID_Idioma'];
        $departamentos = Departamento::all();
        //dd($columnas);
        return (view('reportes.inicio',compact('columnase','departamentos','columnasp','columnasu')));
    }
    
    //Personalizado
    public function reporteempleadopersonalizado(Request $request)
    {
        // Obtener las columnas seleccionadas de empleados y usuarios
        $columnase = $request->input('columnasempleados', []);
        $columnasu = $request->input('columnasusuarios', []);

        $empleados = Empleado::all();

        // Descargar el archivo personalizado
        if($request->extension == 'excel'){
            return Excel::download(new EmpleadoPersonalizadoExport($columnase,$columnasu,$empleados), 'empleados_personalizados.xlsx');
        }else if($request->extension == 'pdf'){
            return Excel::download(new EmpleadoPersonalizadoExport($columnase,$columnasu,$empleados), 'empleados_personalizados.pdf', Format::DOMPDF);
        }else if($request->extension == 'html'){
            return Excel::download(new EmpleadoPersonalizadoExport($columnase,$columnasu,$empleados), 'empleados_personalizados.html', Format::HTML);
        }else{
            return Excel::download(new EmpleadoPersonalizadoExport($columnase,$columnasu,$empleados), 'empleados_personalizados.csv', Format::CSV);
        }
    }
    public function reportedepartamentoempleadopersonalizado(Request $request)
    {
        $columnase = $request->input('columnasempleados', []);
        $columnasu = $request->input('columnasusuarios', []);
        $empleados = Empleado::where('ID_Departamento','=',$request->ID_Departamento)->get();

        // Descargar el archivo personalizado
        if($request->extension == 'excel'){
            return Excel::download(new EmpleadoPersonalizadoExport($columnase,$columnasu,$empleados), 'empleados_personalizados.xlsx');
        }else if($request->extension == 'pdf'){
            return Excel::download(new EmpleadoPersonalizadoExport($columnase,$columnasu,$empleados), 'empleados_personalizados.pdf', Format::DOMPDF);
        }else if($request->extension == 'html'){
            return Excel::download(new EmpleadoPersonalizadoExport($columnase,$columnasu,$empleados), 'empleados_personalizados.html', Format::HTML);
        }else{
            return Excel::download(new EmpleadoPersonalizadoExport($columnase,$columnasu,$empleados), 'empleados_personalizados.csv', Format::CSV);
        }
    }
    public function reportepostulantepersonalizado(Request $request)
    {
        // Obtener las columnas seleccionadas de empleados y usuarios
        $columnasp = $request->input('columnaspostulantes', []);
        $columnasu = $request->input('columnasusuarios', []);

        $postulantes = Postulante::all();

        // Descargar el archivo personalizado
        if($request->extension == 'excel'){
            return Excel::download(new EmpleadoPersonalizadoExport($columnasp,$columnasu,$postulantes), 'empleados_personalizados.xlsx');
        }else if($request->extension == 'pdf'){
            return Excel::download(new EmpleadoPersonalizadoExport($columnasp,$columnasu,$postulantes), 'empleados_personalizados.pdf', Format::DOMPDF);
        }else if($request->extension == 'html'){
            return Excel::download(new EmpleadoPersonalizadoExport($columnasp,$columnasu,$postulantes), 'empleados_personalizados.html', Format::HTML);
        }else{
            return Excel::download(new EmpleadoPersonalizadoExport($columnasp,$columnasu,$postulantes), 'empleados_personalizados.csv', Format::CSV);
        }
    }

    //General
    public function excelpostulante(){
        $postulantes = Postulante::all();
        return Excel::download(new PostulanteExport($postulantes), 'postulantes.xlsx');
    }
    public function csvpostulante(){
        $postulantes = Postulante::all();
        return Excel::download(new PostulanteExport($postulantes), 'postulantes.csv', Format::CSV);
    }
    public function pdfpostulante(){
        $postulantes = Postulante::all();
        return Excel::download(new PostulanteExport($postulantes), 'postulantes.pdf', Format::DOMPDF);
    }
    public function htmlpostulante(){
        $postulantes = Postulante::all();
        return Excel::download(new PostulanteExport($postulantes), 'postulantes.html', Format::HTML);
    }
    public function excelempleado(){
        $empleados = Empleado::select('ID_Usuario', 'genero', 'estadocivil', 'fechanac','ID_Cargo','ID_Departamento') 
                    ->with(['cargo:id,nombre', 'departamento:id,nombre'])
                    ->get();

        return Excel::download(new EmpleadoExport($empleados), 'empleados.xlsx');
    }
    public function csvempleado(){
        $empleados = Empleado::select('ID_Usuario', 'genero', 'estadocivil', 'fechanac','ID_Cargo','ID_Departamento') 
                    ->with(['cargo:id,nombre', 'departamento:id,nombre'])
                    ->get();
        return Excel::download(new EmpleadoExport($empleados), 'empleados.csv', Format::CSV);
    }
    public function pdfempleado(){
        $empleados = Empleado::select('ID_Usuario', 'genero', 'estadocivil', 'fechanac','ID_Cargo','ID_Departamento') 
                    ->with(['cargo:id,nombre', 'departamento:id,nombre'])
                    ->get();
        return Excel::download(new EmpleadoExport($empleados), 'empleados.pdf', Format::DOMPDF);
    }
    public function htmlempleado(){
        $empleados = Empleado::select('ID_Usuario', 'genero', 'estadocivil', 'fechanac','ID_Cargo','ID_Departamento') 
                    ->with(['cargo:id,nombre', 'departamento:id,nombre'])
                    ->get();
        return Excel::download(new EmpleadoExport($empleados), 'empleados.html', Format::HTML);
    }
   

}
