<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $table = 'empleados';

    protected $primaryKey = 'ID_Usuario';

    protected $fillable = [
        'ID_Cargo',
        'ruta_imagen_e',
        'ID_Departamento',
        'ID_Cargo'
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

    public function getEdadAttribute()
    {
        return Carbon::parse($this->fechanac)->age;
    }
}
