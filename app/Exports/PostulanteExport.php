<?php

namespace App\Exports;

use App\Models\Postulante;
use Maatwebsite\Excel\Concerns\FromCollection;

class PostulanteExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Postulante::select('ID_Usuario','fecha_de_nacimiento','nacionalidad', 'habilidades','ID_Fuente_De_Contratacion','ID_Puesto_Disponible','ID_Idioma','created_at','updated_at')->get();
    }
}
