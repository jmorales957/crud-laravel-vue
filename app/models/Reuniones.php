<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Reuniones extends Model
{
    const PENDIENTE = "P";
    const REALIZADO = "R";
    const NO_REALIZADO = "NR";
    protected $table =  'reuniones';
    protected $fillable = [
        'aunto',
        'fecha_hora',
        'lugar',
        'estatus',
        'prospectos_id'
    ];
}
