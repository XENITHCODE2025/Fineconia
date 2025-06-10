<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gasto extends Model
{
    use HasFactory;

    protected $table = 'gastos';
    protected $primaryKey = 'id_Gasto';

    protected $fillable = [
        'descripcion',
        'categoria_id',
        'monto',
        'fecha',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
// (opcional) alias en inglés si lo necesitas
public function getDescriptionAttribute()
{
    return $this->descripcion;
}
}
