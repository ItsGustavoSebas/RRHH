<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Empleado extends Model
{
    use HasFactory;
    use HasRoles;

    protected $table = 'empleados';

    protected $primaryKey = 'ID_Usuario';

    protected $fillable = [
        'ID_Cargo',
        'ruta_imagen_e',
        'ID_Departamento',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'ID_Usuario');
    }

    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'ID_Departamento');
    }

    public function cargo()
    {
        return $this->belongsTo(Cargo::class, 'ID_Cargo');
    }

}
