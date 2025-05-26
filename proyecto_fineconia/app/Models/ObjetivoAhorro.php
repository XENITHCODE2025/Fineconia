<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ObjetivoAhorro extends Model
{
    protected $fillable = [
    'usuario_id',
    'nombre_objetivo',
    'monto_meta',
    'monto_actual',
    'fecha_limite'
];

}
