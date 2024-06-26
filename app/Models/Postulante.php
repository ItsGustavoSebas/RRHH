<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Postulante extends Model
{
    use HasFactory;
    use HasRoles;

    protected $table = 'postulantes';

    protected $primaryKey = 'ID_Usuario';

    protected $fillable = [
        'ruta_imagen_e',
        'fecha_de_nacimiento',
        'nacionalidad',
        'habilidades',
        'puntos',
        'estado',
        'ID_Fuente_De_Contratacion',
        'ID_Puesto_Disponible',
        'ID_Idioma',
        'ID_NivelIdioma',
    ];

    // Relación con el modelo Usuario
    public function usuario()
    {
        return $this->belongsTo(User::class, 'ID_Usuario');
    }


    //relación con fuente de contratacion
    public function fuente_de_contratacion()
    {
        return $this->belongsTo(Fuente_De_Contratacion::class, 'ID_Fuente_De_Contratacion');
    }

    public function contrato()
    {
        return $this->hasOne(Pre_Contrato::class, 'ID_Postulante')->latest();
    }


    //relación con puesto disponible al que se postula
    public function puesto_disponible()
    {
        return $this->belongsTo(Puesto_Disponible::class, 'ID_Puesto_Disponible');
    }

    //relación con idiomas
    public function idioma()
    {
        return $this->belongsTo(Idioma::class, 'ID_Idioma');
    }    

    public function nivel_idioma()
    {
        return $this->belongsTo(Nivel_Idioma::class, 'ID_NivelIdioma');
    }   

    public function referencias()
    {
        return $this->hasMany(Referencia::class, 'ID_Postulante');
    }

    public function educaciones()
    {
        return $this->hasMany(Educacion::class, 'ID_Postulante');
    }

    public function reconocimientos()
    {
        return $this->hasMany(Reconocimiento::class, 'ID_Postulante');
    }

    public function experiencias()
    {
        return $this->hasMany(Experiencia::class, 'ID_Postulante');
    }

    public function entrevista()
    {
        return $this->hasOne(Entrevista::class, 'ID_Postulante')->latest();
    }
}
