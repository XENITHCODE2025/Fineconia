<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PoliticaSeguridad extends Model
{
    protected $table = 'politicas_seguridad';

    protected $fillable = [
        'orden',
        'titulo',
        'subtitulo',
        'contenido',
    ];
}
