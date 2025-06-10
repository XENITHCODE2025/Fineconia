<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaGasto extends Model
{
    use HasFactory;

    protected $table      = 'categorias_gastos';
    protected $primaryKey = 'id_categoriaGasto';

    protected $fillable   = ['nombre'];

    /* Relaciones */
    public function gastos()
    {
        return $this->hasMany(Gasto::class, 'categoria_id', 'id_categoriaGasto');
    }

    public function presupuestos()
    {
        return $this->hasMany(Presupuesto::class, 'categoria_id', 'id_categoriaGasto');
    }
}
