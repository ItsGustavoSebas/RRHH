<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;
    protected $table = 'departamentos';

    protected $primaryKey = 'id';

    protected $fillable = [
        'Nombre',
    ];

    public function empleados()
    {
        return $this->hasMany(Empleado::class, 'ID_Departamento');
    }

    public function cargos()
    {
        return $this->hasMany(Cargo::class, 'ID_Cargo');
    }

}
