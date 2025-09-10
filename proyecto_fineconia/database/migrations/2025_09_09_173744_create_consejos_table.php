<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsejosTable extends Migration
{
    public function up()
    {
        Schema::create('consejos', function (Blueprint $table) {
            $table->id();
            $table->string('categoria');    // ej: "Compras Inteligentes"
            $table->string('titulo')->nullable();
            $table->text('descripcion');
            $table->json('subconsejos')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('consejos');
    }
}

