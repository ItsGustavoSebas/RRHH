<?php

namespace App\Http\Controllers;

use App\Exports\EmpleadoExport;
use App\Exports\EmpleadoPersonalizadoExport;
use App\Exports\PostulanteExport;
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
        $columnas = Schema::getColumnListing('empleados');
        //dd($columnas);
        return (view('reportes.inicio',compact('columnas')));
    }
    
    //Personalizado
    public function excelempleadopersonalizado(Request $request)
    {
        $columnasSeleccionadas = $request->input('columnas', []);

        // Descargar el archivo Excel personalizado
        return Excel::download(new EmpleadoPersonalizadoExport($columnasSeleccionadas), 'empleados_personalizados.xlsx');
    }

    //General
    public function excelpostulante(){
        return Excel::download(new PostulanteExport, 'postulantes.xlsx');
    }
    public function csvpostulante(){
        return Excel::download(new PostulanteExport, 'postulantes.csv', Format::CSV);
    }
    public function pdfpostulante(){
        return Excel::download(new PostulanteExport, 'postulantes.pdf', Format::DOMPDF);
    }
    public function htmlpostulante(){
        return Excel::download(new PostulanteExport, 'postulantes.html', Format::HTML);
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
