<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dias_Festivos extends Model
{
    use HasFactory;
    protected $table = 'dias_festivos';

    protected $primaryKey = 'id';

    protected $fillable = [
        'fecha',
        'concepto',
    ];
}
