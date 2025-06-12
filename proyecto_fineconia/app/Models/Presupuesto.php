<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\CategoriaGasto;

class Presupuesto extends Model
{
    use HasFactory;

    protected $table      = 'presupuestos';
    protected $primaryKey = 'id_Presupuesto';

    protected $fillable = [
        'user_id',
        'categoria_id',
        'monto',
        'restante',
    ];

    /* Relaciones */
    public function categoriaGasto()
    {
        return $this->belongsTo(CategoriaGasto::class, 'categoria_id', 'id_categoriaGasto');
    }
    

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function ajustarMonto(float $nuevoMonto): void
    {
        $diferencia = $nuevoMonto - $this->monto;   // + si sube el límite
        $this->monto = $nuevoMonto;
        $this->restante += $diferencia;
        $this->restante = max($this->restante, 0);      // nunca negativo
        $this->save();
    }
}
