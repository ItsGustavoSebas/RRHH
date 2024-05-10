<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referencia extends Model
{
    use HasFactory;
    protected $table = 'referencias';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre', 
        'descripcion', 
        'telefono', 

    ];


    public function postulante()
    {
        return $this->belongsTo(Postulante::class, 'ID_Usuario');
    } 
}
