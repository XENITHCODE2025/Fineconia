<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consejo extends Model
{
    protected $table = 'consejos';

    protected $fillable = [
        'categoria',
        'titulo',
        'descripcion',
        'subconsejos',
    ];

    protected $casts = [
        'subconsejos' => 'array',
    ];
}
