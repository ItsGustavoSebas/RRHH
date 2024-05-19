<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'emisor_id', 'receptor_id', 'mensaje', 'leido','creado','updated_at'
    ];

    public function emisor()
    {
        return $this->belongsTo(User::class, 'emisor_id');
    }

    public function receptor()
    {
        return $this->belongsTo(User::class, 'receptor_id');
    }

    public function setCreatedAt($value)
    {
        $this->attributes['creado'] = Carbon::createFromFormat('Y-m-d H:i:s', $value, 'America/La_Paz');
    }

    public function setUpdatedAt($value)
    {
        $this->attributes['updated_at'] = Carbon::createFromFormat('Y-m-d H:i:s', $value, 'America/La_Paz');
    }
}
