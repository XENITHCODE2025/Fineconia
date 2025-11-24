<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TerminoCondicion extends Model
{
    protected $table = 'terminos_condiciones';

    protected $fillable = [
        'orden',
        'titulo',
        'subtitulo',
        'contenido',
    ];
}
