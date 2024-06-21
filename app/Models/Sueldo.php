<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sueldo extends Model
{
    use HasFactory;
    protected $table = 'sueldo';

    protected $primaryKey = 'id';

    protected $fillable = [
        'sueldo_basico',
        'dias_pagados',
        'horas_diarias',
    ];
}
