<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guia extends Model
{
    public function up(): void
{
    Schema::create('guias', function (Blueprint $table) {
        $table->id('id_Guia');
        $table->string('titulo');
        $table->string('categoria');
        $table->string('archivo'); // ruta relativa dentro de storage/app/public
        $table->timestamps();
    });
}

}
