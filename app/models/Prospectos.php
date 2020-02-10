<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prospectos extends Model
{
    use SoftDeletes;
    protected $table = 'prospectos';

    protected $fillable = [
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'celular',
        'email',
        'estatus',
    ];


    public function llamadas () {
        return $this->hasMany('App\models\Llamadas');
    }

    public function reuniones () {
        return $this->hasMany('App\models\Reuniones');
    }


}
