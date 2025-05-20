<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gasto extends Model
{
    use HasFactory;

    // Opcionalmente, si cambiaste el nombre de tu ID a "id_Gasto":
    protected $primaryKey = 'id_Gasto';

    // Los campos que puedes asignar de forma masiva (fillable)
    protected $fillable = [
        'fecha',
        'descripcion',
        'categoria',
        'monto',
    ];
}
