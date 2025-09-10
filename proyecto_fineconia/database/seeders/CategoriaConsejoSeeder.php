<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaConsejoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    // database/seeders/CategoriaConsejoSeeder.php
public function run()
{
    $categorias = [
        'Presupuesto',
        'Compras Inteligentes',
        'Energía y Servicio',
        'Metas de Ahorro',
        'Familiar',
    ];

    foreach ($categorias as $cat) {
        \App\Models\CategoriaConsejo::create(['nombre' => $cat]);
    }
}

}
