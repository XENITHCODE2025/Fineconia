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
        Schema::table('objetivos_ahorro', function (Blueprint $table) {
            $table->decimal('monto_ahorrado', 12, 2)->default(0)->after('monto');
        });
    }

    public function down()
    {
        Schema::table('objetivos_ahorro', function (Blueprint $table) {
            $table->dropColumn('monto_ahorrado');
        });
    }
};
