<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Idioma extends Model
{
    use HasFactory;
    protected $table = 'idiomas';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre', 
        'ID_NivelIdioma',
    ];




}
