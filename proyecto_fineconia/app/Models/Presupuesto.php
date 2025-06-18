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
        'mes',
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

     /** % de presupuesto gastado (máx. 100 %) */
    public function getPctAttribute(): float
    {
        if ($this->monto <= 0) {
            return 0;
        }

        $gastado = $this->monto - $this->restante;          // lo usado
        $pct     = ($gastado / $this->monto) * 100;

        return round(min($pct, 100), 2);
    }

    /** Clase CSS según el rango de porcentaje */
    public function getBarClassAttribute(): string
    {
        return match (true) {
            $this->pct < 70  => 'prog-green',   // < 70 %
            $this->pct < 90  => 'prog-orange',  // 70-89 %
            default          => 'prog-red',     // ≥ 90 %
        };
    }
}
