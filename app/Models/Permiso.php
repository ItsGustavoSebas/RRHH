<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    protected $table = 'permisos';

    protected $fillable = [
        'user_id',
        'motivo',
        'fecha_inicio',
        'fecha_fin',
        'aprobado',
        'denegado',
    ];

    // Definir la relación con el modelo de usuario
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}