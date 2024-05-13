<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nivel_Idioma extends Model
{
    use HasFactory;
    protected $table = 'nivel_idioma';

    protected $primaryKey = 'id';

    protected $fillable = [
        'categoria', 
   
    ];

}
