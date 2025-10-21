<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('favoritos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('guia_path'); // ruta relativa dentro de storage/public/guias
            $table->timestamps();

            $table->unique(['user_id', 'guia_path']); // evita duplicados
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('favoritos');
    }
};

