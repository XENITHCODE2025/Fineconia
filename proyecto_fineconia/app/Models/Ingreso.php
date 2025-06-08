<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    use HasFactory;

    protected $table = 'ingresos';
    protected $primaryKey = 'id_Ingreso';

    protected $fillable = [
        'user_id',
        'fecha',
        'descripcion',
        'categoria',
        'monto',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Alias para compatibilidad en inglés
    public function getDescriptionAttribute()
    {
        return $this->descripcion;
    }

    /**
     * Devuelve la suma total de 'monto' para un usuario dado.
     */
    public static function totalPorUsuario(int $userId): float
    {
        return (float) self::where('user_id', $userId)->sum('monto');
    }
}
