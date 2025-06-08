<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    use HasFactory;

    protected $table = 'ingresos'; // En caso de que no hayas seguido la convención
    protected $primaryKey = 'id_Ingreso';

    protected $fillable = [
        'descripcion',
        'categoria',
        'monto',
        'fecha',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // alias para compatibilidad con inglés
public function getDescriptionAttribute()
{
    return $this->descripcion;   // permitirá usar $ingreso->description
}
}
