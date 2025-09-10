<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Consejo;

class ConsejosSeeder extends Seeder
{
    public function run()
    {
        // --- COMPRAS INTELIGENTES ---
        $compras = [
            [
                'titulo' => 'Haz una lista de compras y respétala.',
                'descripcion' => 'Así evitas gastar en cosas que no necesitas.',
                'subconsejos' => [
                    'Revisa lo que ya tienes en casa antes de comprar.',
                    'Planea menús semanales para organizar mejor la lista.',
                    'No compres nada que no esté anotado.',
                ],
            ],
            [
                'titulo' => 'Compara precios antes de decidir.',
                'descripcion' => 'Los mismos productos pueden variar bastante de una tienda a otra.',
                'subconsejos' => [
                    'Usa aplicaciones o sitios web para comparar.',
                    'Ten en cuenta costos de envío en compras online.',
                    'Fíjate también en la calidad, no solo en el precio.',
                ],
            ],
            [
                'titulo' => 'Aprovecha ofertas y descuentos.',
                'descripcion' => 'Bien usados, te ayudan a reducir gastos.',
                'subconsejos' => [
                    'Compra en días de promoción como Black Friday o 2x1.',
                    'Utiliza cupones o programas de puntos.',
                    'Evita comprar algo solo porque está rebajado.',
                ],
            ],
            [
                'titulo' => 'Elige calidad sobre cantidad.',
                'descripcion' => 'Un producto duradero te hará gastar menos a largo plazo.',
                'subconsejos' => [
                    'Lee reseñas antes de comprar.',
                    'Revisa garantía y servicio postventa.',
                    'Evita lo muy barato si sabes que se romperá rápido.',
                ],
            ],
            [
                'titulo' => 'Evita compras impulsivas.',
                'descripcion' => 'La emoción del momento suele llevarte a gastar de más.',
                'subconsejos' => [
                    'Aplica la regla de las 24 horas antes de decidir.',
                    'Pregúntate si lo usarás realmente.',
                    'Calcula cuántas horas de trabajo te cuesta.',
                ],
            ],
            [
                'titulo' => 'Compra al por mayor lo que usas seguido.',
                'descripcion' => 'Reduce el costo por unidad y ahorras viajes a la tienda.',
                'subconsejos' => [
                    'Enfócate en productos no perecederos.',
                    'Revisa la fecha de caducidad.',
                    'Guarda espacio en casa para almacenarlos bien.',
                ],
            ],
            [
                'titulo' => 'Evalúa la necesidad real de cada compra.',
                'descripcion' => 'Diferencia entre “necesito” y “quiero”.',
                'subconsejos' => [
                    'Pregúntate si puedes vivir sin ello.',
                    'Busca alternativas más baratas o gratuitas.',
                    'Dale prioridad a lo esencial.',
                ],
            ],
            [
                'titulo' => 'Revisa reseñas antes de comprar online.',
                'descripcion' => 'Te ahorras sorpresas y devoluciones.',
                'subconsejos' => [
                    'Lee comentarios recientes.',
                    'Verifica calificaciones de la tienda o vendedor.',
                    'Observa fotos de otros compradores.',
                ],
            ],
            [
                'titulo' => 'Elige marcas con garantía.',
                'descripcion' => 'Te dará tranquilidad y seguridad en tu inversión.',
                'subconsejos' => [
                    'Verifica tiempo de garantía y condiciones.',
                    'Guarda facturas y comprobantes.',
                    'Prefiere marcas con servicio técnico cercano.',
                ],
            ],
            [
                'titulo' => 'Evita intereses con tarjetas de crédito.',
                'descripcion' => 'Si no pagas a tiempo, la compra sale mucho más cara.',
                'subconsejos' => [
                    'Paga el total de tu tarjeta cada mes.',
                    'Usa tarjeta solo para compras planificadas.',
                    'Aprovecha tarjetas con beneficios, no las que cobran más intereses.',
                ],
            ],
        ];

        // --- ENERGÍA Y SERVICIOS ---
        $energia = [
            [
                'titulo' => 'Apaga luces y aparatos cuando no los uses.',
                'descripcion' => 'Pequeños hábitos reducen mucho la factura.',
                'subconsejos' => [
                    'Revisa habitaciones antes de salir.',
                    'Usa regletas para apagar varios aparatos a la vez.',
                    'Desconecta cargadores que no estés usando.',
                ],
            ],
            [
                'titulo' => 'Usa focos LED.',
                'descripcion' => 'Gastan menos energía y duran más.',
                'subconsejos' => [
                    'Sustituye poco a poco los bombillos antiguos.',
                    'Elige focos con buena eficiencia energética.',
                    'Aunque son más caros, se recupera en la factura.',
                ],
            ],
            [
                'titulo' => 'Elige electrodomésticos eficientes.',
                'descripcion' => 'Reducen el consumo mensual.',
                'subconsejos' => [
                    'Busca etiquetas de eficiencia energética.',
                    'Evita electrodomésticos viejos que consumen mucho.',
                    'Haz mantenimiento regular para que funcionen mejor.',
                ],
            ],
            [
                'titulo' => 'Modera el uso de aire acondicionado y calefacción.',
                'descripcion' => 'Son de los aparatos que más consumen.',
                'subconsejos' => [
                    'Ajusta a temperaturas moderadas.',
                    'Limpia filtros con frecuencia.',
                    'Usa ventiladores o ropa adecuada como alternativa.',
                ],
            ],
            [
                'titulo' => 'Repara fugas de agua.',
                'descripcion' => 'Una fuga pequeña puede aumentar bastante la factura.',
                'subconsejos' => [
                    'Revisa llaves y tuberías.',
                    'Cambia empaques o piezas dañadas.',
                    'Cierra bien grifos después de usarlos.',
                ],
            ],
            [
                'titulo' => 'Usa lavadora y lavavajillas con cargas completas.',
                'descripcion' => 'Ahorras agua y electricidad.',
                'subconsejos' => [
                    'Junta suficiente ropa antes de lavar.',
                    'Usa programas cortos o de bajo consumo.',
                    'Prefiere agua fría cuando sea posible.',
                ],
            ],
            [
                'titulo' => 'Instala temporizadores o sensores de luz.',
                'descripcion' => 'Se encienden solo cuando es necesario.',
                'subconsejos' => [
                    'Útiles en pasillos, patios y exteriores.',
                    'Evitan que las luces se queden encendidas por descuido.',
                    'Hay opciones económicas fáciles de instalar.',
                ],
            ],
            [
                'titulo' => 'Aprovecha la luz natural.',
                'descripcion' => 'Reduce la necesidad de encender focos.',
                'subconsejos' => [
                    'Abre cortinas durante el día.',
                    'Usa colores claros en paredes para reflejar la luz.',
                    'Organiza tu espacio de trabajo cerca de ventanas.',
                ],
            ],
            [
                'titulo' => 'Mantén puertas y ventanas bien cerradas.',
                'descripcion' => 'Conservas la temperatura interior y reduces consumo.',
                'subconsejos' => [
                    'Coloca burletes en puertas y ventanas.',
                    'Evita filtraciones de aire.',
                    'Aprovecha cortinas gruesas para mantener calor o frío.',
                ],
            ],
            [
                'titulo' => 'Compara tarifas de servicios.',
                'descripcion' => 'Puedes estar pagando más de lo necesario.',
                'subconsejos' => [
                    'Revisa opciones de planes de energía o internet.',
                    'Ajusta el plan según tus necesidades reales.',
                    'Cambia de proveedor si otro ofrece mejores beneficios.',
                ],
            ],
        ];

        // --- METAS DE AHORRO ---
        $metas = [
            [
                'titulo' => 'Define metas claras y específicas.',
                'descripcion' => 'Saber para qué ahorras te motiva más.',
                'subconsejos' => [
                    'Pon montos y fechas.',
                    'Escríbelas para recordarlas.',
                    'Divide la meta en pasos pequeños.',
                ],
            ],
            [
                'titulo' => 'Ponle plazo a cada meta.',
                'descripcion' => 'Tener fecha límite te mantiene enfocada.',
                'subconsejos' => [
                    'Define una meta a corto plazo y otra a largo plazo.',
                    'Usa un calendario para llevar control.',
                    'Ajusta fechas si hay imprevistos.',
                ],
            ],
            [
                'titulo' => 'Automatiza el ahorro.',
                'descripcion' => 'Para que no dependas de la fuerza de voluntad.',
                'subconsejos' => [
                    'Programa transferencias automáticas en tu banco.',
                    'Separa tu ahorro apenas recibas tu sueldo.',
                    'Considera ese dinero como intocable.',
                ],
            ],
            [
                'titulo' => 'Prioriza tus metas.',
                'descripcion' => 'No todas tienen la misma urgencia.',
                'subconsejos' => [
                    'Primero ahorro para emergencias.',
                    'Después metas de educación o salud.',
                    'Finalmente metas de ocio o viajes.',
                ],
            ],
            [
                'titulo' => 'Celebra logros pequeños.',
                'descripcion' => 'Te motiva a seguir ahorrando.',
                'subconsejos' => [
                    'Regálate algo simbólico al cumplir una parte.',
                    'Comparte tu progreso con alguien de confianza.',
                    'Refuerza la disciplina con recompensas sanas.',
                ],
            ],
            [
                'titulo' => 'Revisa tu progreso regularmente.',
                'descripcion' => 'Mantén el control para no desviarte.',
                'subconsejos' => [
                    'Hazlo cada semana o mes.',
                    'Usa tablas o gráficos para ver avances.',
                    'Ajusta montos si cambian tus ingresos.',
                ],
            ],
            [
                'titulo' => 'Evita tocar el dinero de la meta.',
                'descripcion' => 'Si lo usas, pierdes el ritmo.',
                'subconsejos' => [
                    'Guárdalo en una cuenta separada.',
                    'Usa alcancías digitales o físicas.',
                    'Activa bloqueos en apps para no retirarlo fácil.',
                ],
            ],
            [
                'titulo' => 'Ajusta metas según tu situación.',
                'descripcion' => 'No siempre todo sale como lo planeaste.',
                'subconsejos' => [
                    'Si tus ingresos bajan, reduce montos pero no abandones la meta.',
                    'Si suben, incrementa el ahorro.',
                    'Sé flexible, pero constante.',
                ],
            ],
            [
                'titulo' => 'Visualiza tu meta.',
                'descripcion' => 'Verla te mantiene motivada.',
                'subconsejos' => [
                    'Haz un tablero con fotos de lo que quieres.',
                    'Marca cada avance en un gráfico.',
                    'Lleva un registro visible en tu habitación.',
                ],
            ],
            [
                'titulo' => 'Separa metas por prioridad.',
                'descripcion' => 'Así aprovechas mejor tus ingresos.',
                'subconsejos' => [
                    'Identifica metas urgentes y no urgentes.',
                    'Destina un porcentaje a cada una.',
                    'Enfócate en cumplir una antes de empezar otra.',
                ],
            ],
        ];

        // --- FAMILIAR ---
        $familiar = [
            [
                'titulo' => 'Educa a los niños sobre el ahorro.',
                'descripcion' => 'Es un hábito que se aprende desde pequeños.',
                'subconsejos' => [
                    'Dales una alcancía.',
                    'Enséñales a separar dinero en partes.',
                    'Recompensa su disciplina.',
                ],
            ],
            [
                'titulo' => 'Planifiquen el presupuesto familiar juntos.',
                'descripcion' => 'Que todos participen aumenta el compromiso.',
                'subconsejos' => [
                    'Hagan una reunión mensual.',
                    'Revisen ingresos y gastos.',
                    'Propongan ideas para ahorrar.',
                ],
            ],
            [
                'titulo' => 'Hagan compras conjuntas.',
                'descripcion' => 'Comprar en grupo reduce costos.',
                'subconsejos' => [
                    'Compren al por mayor productos de la casa.',
                    'Dividan gastos de transporte.',
                    'Eviten duplicar cosas innecesarias.',
                ],
            ],
            [
                'titulo' => 'Establezcan metas de ahorro familiares.',
                'descripcion' => 'Motiva más cuando el objetivo es compartido.',
                'subconsejos' => [
                    'Ahorrar para vacaciones en familia.',
                    'Mejorar la casa o comprar un electrodoméstico.',
                    'Definir montos y tiempos juntos.',
                ],
            ],
            [
                'titulo' => 'Reduzcan gastos compartiendo recursos.',
                'descripcion' => 'Una buena organización evita derroches.',
                'subconsejos' => [
                    'Usen un solo servicio de streaming.',
                    'Compartan transporte o actividades.',
                    'Reutilicen y reciclen en casa.',
                ],
            ],
            [
                'titulo' => 'Realicen actividades recreativas económicas.',
                'descripcion' => 'No siempre es necesario gastar para divertirse.',
                'subconsejos' => [
                    'Juegos de mesa en casa.',
                    'Paseos al parque o caminatas.',
                    'Cocinar juntos en lugar de salir.',
                ],
            ],
            [
                'titulo' => 'Cree un fondo común para emergencias.',
                'descripcion' => 'Protege a toda la familia en momentos difíciles.',
                'subconsejos' => [
                    'Cada miembro aporta una cantidad fija.',
                    'Guárdenlo en una cuenta conjunta.',
                    'Úsenlo solo para emergencias reales.',
                ],
            ],
            [
                'titulo' => 'Evalúen gastos familiares regularmente.',
                'descripcion' => 'Revisar juntos evita sorpresas.',
                'subconsejos' => [
                    'Revisen facturas y recibos.',
                    'Ajusten suscripciones o servicios.',
                    'Busquen alternativas más baratas.',
                ],
            ],
            [
                'titulo' => 'Promuevan hábitos de consumo responsable.',
                'descripcion' => 'Enseñar con el ejemplo es lo más efectivo.',
                'subconsejos' => [
                    'Eviten desperdiciar comida.',
                    'Apaguen luces y aparatos.',
                    'Cuiden el agua en casa.',
                ],
            ],
            [
                'titulo' => 'Recompensen los logros en equipo.',
                'descripcion' => 'Alcanzar metas juntos fortalece la unión.',
                'subconsejos' => [
                    'Celebren cuando logren un objetivo de ahorro.',
                    'Organicen una actividad especial.',
                    'Refuercen la importancia de trabajar en conjunto.',
                ],
            ],
        ];

        // --- PRESUPUESTOS (10 consejos inventados para completar) ---
        $presupuesto = [
            [
                'titulo' => 'Registra todos tus ingresos y gastos.',
                'descripcion' => 'Conocer tus movimientos es el primer paso.',
                'subconsejos' => [
                    'Anótalos en una libreta o app.',
                    'Hazlo diariamente.',
                    'Clasifica cada gasto en una categoría.',
                ],
            ],
            [
                'titulo' => 'Define un presupuesto mensual.',
                'descripcion' => 'Te ayudará a mantener tus finanzas bajo control.',
                'subconsejos' => [
                    'Establece un límite de gasto.',
                    'Incluye ahorro como una categoría.',
                    'Sé realista al definir los montos.',
                ],
            ],
            [
                'titulo' => 'Aplica la regla 50/30/20.',
                'descripcion' => 'Divide tus ingresos en necesidades, deseos y ahorro.',
                'subconsejos' => [
                    '50% necesidades.',
                    '30% deseos.',
                    '20% ahorro.',
                ],
            ],
            [
                'titulo' => 'Separa gastos fijos de variables.',
                'descripcion' => 'Así podrás identificar qué puedes reducir.',
                'subconsejos' => [
                    'Renta, luz y agua son fijos.',
                    'Comidas fuera son variables.',
                    'Reduce lo variable primero.',
                ],
            ],
            [
                'titulo' => 'Usa sobres o cuentas separadas.',
                'descripcion' => 'Te ayuda a organizar mejor el dinero.',
                'subconsejos' => [
                    'Un sobre para cada categoría.',
                    'Evita mezclar dinero.',
                    'Usa cuentas digitales si es posible.',
                ],
            ],
            [
                'titulo' => 'Revisa tu presupuesto cada semana.',
                'descripcion' => 'Ajusta lo que sea necesario para no desviarte.',
                'subconsejos' => [
                    'Compara lo planeado vs lo real.',
                    'Corrige gastos innecesarios.',
                    'Ajusta montos si cambian tus ingresos.',
                ],
            ],
            [
                'titulo' => 'Incluye un fondo de emergencias.',
                'descripcion' => 'Siempre habrá imprevistos.',
                'subconsejos' => [
                    'Ahorra al menos 3 meses de gastos.',
                    'Guárdalo en una cuenta de fácil acceso.',
                    'No lo uses salvo urgencias reales.',
                ],
            ],
            [
                'titulo' => 'Evita endeudarte más de lo necesario.',
                'descripcion' => 'Las deudas descontroladas arruinan el presupuesto.',
                'subconsejos' => [
                    'Usa crédito solo si puedes pagar.',
                    'Evita intereses altos.',
                    'Paga siempre a tiempo.',
                ],
            ],
            [
                'titulo' => 'Prioriza tus gastos esenciales.',
                'descripcion' => 'Lo básico debe ir primero.',
                'subconsejos' => [
                    'Vivienda, comida y salud.',
                    'Después educación y transporte.',
                    'El ocio debe ir al final.',
                ],
            ],
            [
                'titulo' => 'Destina parte a objetivos de largo plazo.',
                'descripcion' => 'Un buen presupuesto mira al futuro.',
                'subconsejos' => [
                    'Incluye metas de estudios.',
                    'Piensa en comprar una casa.',
                    'Ahorra para la jubilación.',
                ],
            ],
        ];

        // Insertar todos
        foreach ([
            'compras' => $compras,
            'energia' => $energia,
            'metas' => $metas,
            'familiar' => $familiar,
            'presupuesto' => $presupuesto,
        ] as $categoria => $lista) {
            foreach ($lista as $item) {
                Consejo::create([
                    'categoria' => $categoria,
                    'titulo' => $item['titulo'],
                    'descripcion' => $item['descripcion'],
                    'subconsejos' => $item['subconsejos'],
                ]);
            }
        }
    }
}