<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    use HasFactory;

    // Como cambiaste el nombre de la llave primaria
    protected $primaryKey = 'id_Ingreso';

    // Campos que se pueden asignar en masa
    protected $fillable = [
        'fecha',
        'descripcion',
        'categoria',
        'monto',
    ];
}
