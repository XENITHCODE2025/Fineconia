<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// app/Models/Gasto.php
class Gasto extends Model
{
    use HasFactory;

    protected $table      = 'gastos';
    protected $primaryKey = 'id_Gasto';

    protected $fillable   = [
        'user_id',
        'fecha',
        'descripcion',
        'categoria_id',   // FK → categorias_gastos
        'monto',
    ];

    /* ───── Relaciones ───── */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categoriaGasto()
    {
        return $this->belongsTo(
            CategoriaGasto::class,
            'categoria_id',
            'id_categoriaGasto'
        );
    }


    // Alias opcional
    public function getDescriptionAttribute()
    {
        return $this->descripcion;
    }
}
