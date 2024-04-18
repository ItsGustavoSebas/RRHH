<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    use HasFactory;

    protected $table = 'cargos';

    protected $primaryKey = 'id';

    protected $fillable = [
        'Nombre',
        'ID_Departamento'
    ];

    public function empleados()
    {
        return $this->hasMany(Empleado::class, 'ID_Cargo');
    }
    public function departamento()
    {
        return $this->belongsTo(Cargo::class, 'ID_Departamento');
    }
}
