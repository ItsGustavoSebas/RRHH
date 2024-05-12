<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pre_Contrato extends Model
{
    use HasFactory;


    protected $table = 'pre_contrato';

    protected $primaryKey =  'id';

    protected $fillable = [
        'ID_Cargo',
        'ID_Departamento',
        'genero',
        'estadocivil',
        'rol',
        'ID_Postulante', 
        'ID_Usuario', 
    ];

    public function postulante()
    {
        return $this->belongsTo(Postulante::class, 'ID_Postulante');
    }

    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'ID_Departamento');
    }

    public function cargo()
    {
        return $this->belongsTo(Cargo::class, 'ID_Cargo');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'ID_Usuario');
    }

    public function getEdadAttribute()
    {
        return Carbon::parse($this->fechanac)->age;
    }
}
