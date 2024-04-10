<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fuente_De_Contratacion extends Model
{
    use HasFactory;
    protected $table = 'fuentes_de_contratacion';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre', 
    ];
}
