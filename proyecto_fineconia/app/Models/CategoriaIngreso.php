<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaIngreso extends Model
{
    use HasFactory;

    protected $table = 'categorias_ingresos'; // nombre exacto de la tabla en la BD
    protected $primaryKey = 'id_categoriaIngreso';

    protected $fillable = ['nombre'];

    public function ingresos()
    {
        return $this->hasMany(Ingreso::class, 'categoria_id', 'id_categoriaIngreso');
    }
}
