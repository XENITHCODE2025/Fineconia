<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjetivoAhorro extends Model
{
    use HasFactory;

    protected $table = 'objetivos_ahorro';

    protected $fillable = [
        'user_id',
        'nombre',
        'monto',
        'fecha_desde',
        'fecha_hasta',
    ];

    // Relación con usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
