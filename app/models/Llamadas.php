<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Llamadas extends Model
{
    const PENDIENTE = "P";
    const REALIZADO = "R";
    const NO_REALIZADO = "NR";

    protected $table = 'llamadas';
    protected $fillable = [
        'aunto',
        'fecha_hora',
        'estatus',
        'prospectos_id'
    ];
}
