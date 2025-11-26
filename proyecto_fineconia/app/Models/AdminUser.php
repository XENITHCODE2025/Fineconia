<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminUser extends Model
{
    use HasFactory;

    protected $table = 'admin_users';

    protected $fillable = [
        'nombre',
        'apellido',
        'email',
        'password',
        'rol',
        'permisos',
        'imagen_url',
    ];

    protected $casts = [
        'permisos' => 'array', // convierte JSON ↔ array automáticamente
    ];
}
