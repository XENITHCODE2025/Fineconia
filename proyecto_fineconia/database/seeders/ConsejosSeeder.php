<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Consejo;

class ConsejosSeeder extends Seeder
{
    public function run(): void
    {
        // ✅ Ejemplo categoría Presupuesto
        Consejo::create([
            'categoria' => 'presupuesto',
            'titulo' => 'Crea un presupuesto mensual',
            'descripcion' => 'Organiza tus ingresos y gastos para no gastar más de lo que ganas.',
            'subconsejos' => [
                'Anota todos tus ingresos y egresos.',
                'Separa una parte fija para el ahorro.',
                'Usa una app o Excel para llevar control.',
            ]
        ]);

        // ✅ Ejemplo categoría Compras
        Consejo::create([
            'categoria' => 'compras',
            'titulo' => 'Haz una lista de compras y respétala',
            'descripcion' => 'Evita comprar artículos innecesarios siguiendo una lista.',
            'subconsejos' => [
                'Revisa lo que ya tienes en casa antes de comprar.',
                'Planea menús semanales.',
                'No compres nada que no esté anotado.',
            ]
        ]);

        // ✅ Ejemplo categoría Energía
        Consejo::create([
            'categoria' => 'energia',
            'titulo' => 'Ahorra en energía eléctrica',
            'descripcion' => 'Pequeños cambios reducen el consumo de electricidad.',
            'subconsejos' => [
                'Apaga las luces que no uses.',
                'Usa bombillas LED.',
                'Desconecta los aparatos que no uses.',
            ]
        ]);

        // ✅ Ejemplo categoría Metas
        Consejo::create([
            'categoria' => 'metas',
            'titulo' => 'Define metas claras de ahorro',
            'descripcion' => 'Tener un objetivo te motiva a ser constante.',
            'subconsejos' => [
                'Establece un monto y una fecha límite.',
                'Divide tu meta en pasos pequeños.',
                'Celebra cada avance.',
            ]
        ]);

        // ✅ Ejemplo categoría Familiar
        Consejo::create([
            'categoria' => 'familiar',
            'titulo' => 'Involucra a tu familia en el ahorro',
            'descripcion' => 'El ahorro es más efectivo cuando todos participan.',
            'subconsejos' => [
                'Habla sobre la importancia del ahorro.',
                'Propongan juntos metas de ahorro familiar.',
                'Premien los logros alcanzados.',
            ]
        ]);
    }
}
