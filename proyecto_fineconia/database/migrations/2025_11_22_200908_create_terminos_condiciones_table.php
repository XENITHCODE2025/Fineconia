<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('terminos_condiciones', function (Blueprint $table) {
            $table->id();
            $table->string('titulo')->nullable();
            $table->string('subtitulo')->nullable();
            $table->longText('contenido');  // Texto de la sección
            $table->integer('orden')->default(0); // Para ordenar las secciones
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('terminos_condiciones');
    }
};
