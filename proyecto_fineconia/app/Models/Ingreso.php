<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    use HasFactory;

    protected $table      = 'ingresos';
    protected $primaryKey = 'id_Ingreso';

    protected $fillable = [
        'descripcion',
        'categoria_id',
        'monto',
        'fecha',
        'user_id',
    ];

    /* ─── Relaciones ─────────────────────────────────────────── */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categoriaIngreso()
    {
        return $this->belongsTo(
            CategoriaIngreso::class,
            'categoria_id',
            'id_categoriaIngreso'
        );
    }
}
