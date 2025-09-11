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
                    'Usa apps de listas de compra para mayor organización',
                    'Establece un presupuesto máximo para la compra',
                    'Organiza la lista por categorías o secciones de la tienda',
                    'Evita ir al supermercado con hambre para reducir tentaciones',
                ],
            ],
            [
                'titulo' => 'Compara precios antes de decidir.',
                'descripcion' => 'Los mismos productos pueden variar bastante de una tienda a otra.',
                'subconsejos' => [
                    'Usa aplicaciones o sitios web para comparar.',
                    'Ten en cuenta costos de envío en compras online.',
                    'Fíjate también en la calidad, no solo en el precio.',
                    'Revisa precios en tiendas físicas y online',
                    'Considera el costo por unidad en lugar del precio total',
                    'Busca códigos de descuento adicionales antes de comprar',
                    'Sigue tiendas en redes sociales para enterarte de promociones',
                ],
            ],
            [
                'titulo' => 'Aprovecha ofertas y descuentos.',
                'descripcion' => 'Bien usados, te ayudan a reducir gastos.',
                'subconsejos' => [
                    'Compra en días de promoción como Black Friday o 2x1.',
                    'Utiliza cupones o programas de puntos.',
                    'Evita comprar algo solo porque está rebajado.',
                    'Suscríbete a newsletters de tus tiendas favoritas',
                    'Revisa las secciones de outlet o liquidación',
                    'Aprovecha descuentos por temporada baja',
                    'Combina ofertas con cupones para maximizar ahorros',
                ],
            ],
            [
                'titulo' => 'Elige calidad sobre cantidad.',
                'descripcion' => 'Un producto duradero te hará gastar menos a largo plazo.',
                'subconsejos' => [
                    'Lee reseñas antes de comprar.',
                    'Revisa garantía y servicio postventa.',
                    'Evita lo muy barato si sabes que se romperá rápido.',
                    'Investiga sobre la reputación de la marca',
                    'Prefiere materiales duraderos aunque sean más caros',
                    'Considera el costo total de propiedad, no solo el precio inicial',
                    'Busca productos con buen valor de reventa',
                ],
            ],
            [
                'titulo' => 'Evita compras impulsivas.',
                'descripcion' => 'La emoción del momento suele llevarte a gastar de más.',
                'subconsejos' => [
                    'Aplica la regla de las 24 horas antes de decidir.',
                    'Pregúntate si lo usarás realmente.',
                    'Calcula cuántas horas de trabajo te cuesta.',
                    'Desactiva notificaciones de tiendas online',
                    'Evita window shopping sin propósito específico',
                    'Establece límites de gasto mensual para caprichos',
                    'Practica mindfulness antes de realizar compras no planificadas',
                ],
            ],
            [
                'titulo' => 'Compra al por mayor lo que usas seguido.',
                'descripcion' => 'Reduce el costo por unidad y ahorras viajes a la tienda.',
                'subconsejos' => [
                    'Enfócate en productos no perecederos.',
                    'Revisa la fecha de caducidad.',
                    'Guarda espacio en casa para almacenarlos bien.',
                    'Organízate con familiares o amigos para compras al mayor',
                    'Calcula el ahorro real considerando espacio de almacenamiento',
                    'Prioriza productos de uso frecuente y alta rotación',
                    'Compara precios entre diferentes mayoristas',
                ],
            ],
            [
                'titulo' => 'Evalúa la necesidad real de cada compra.',
                'descripcion' => 'Diferencia entre "necesito" y "quiero".',
                'subconsejos' => [
                    'Pregúntate si puedes vivir sin ello.',
                    'Busca alternativas más baratas o gratuitas.',
                    'Dale prioridad a lo esencial.',
                    'Crea una lista de espera para deseos no urgentes',
                    'Establece un período de reflexión antes de compras grandes',
                    'Considera el espacio que ocupará el artículo en tu hogar',
                    'Evalúa si realmente soluciona un problema o necesidad',
                ],
            ],
            [
                'titulo' => 'Revisa reseñas antes de comprar online.',
                'descripcion' => 'Te ahorras sorpresas y devoluciones.',
                'subconsejos' => [
                    'Lee comentarios recientes.',
                    'Verifica calificaciones de la tienda o vendedor.',
                    'Observa fotos de otros compradores.',
                    'Busca reseñas en múltiples plataformas',
                    'Presta atención a comentarios sobre servicio al cliente',
                    'Desconfía de productos con solo reseñas perfectas',
                    'Verifica la autenticidad de las reseñas',
                ],
            ],
            [
                'titulo' => 'Elige marcas con garantía.',
                'descripcion' => 'Te dará tranquilidad y seguridad en tu inversión.',
                'subconsejos' => [
                    'Verifica tiempo de garantía y condiciones.',
                    'Guarda facturas y comprobantes.',
                    'Prefiere marcas con servicio técnico cercano.',
                    'Investiga sobre la política de devoluciones',
                    'Considera garantías extendidas para productos costosos',
                    'Registra tus productos en los sitios web del fabricante',
                    'Verifica la cobertura de la garantía en tu país',
                ],
            ],
            [
                'titulo' => 'Evita intereses con tarjetas de crédito.',
                'descripcion' => 'Si no pagas a tiempo, la compra sale mucho más cara.',
                'subconsejos' => [
                    'Paga el total de tu tarjeta cada mes.',
                    'Usa tarjeta solo para compras planificadas.',
                    'Aprovecha tarjetas con beneficios, no las que cobran más intereses.',
                    'Configura alertas de pago para no olvidar fechas límite',
                    'Conoce tu fecha de corte y fecha de pago',
                    'Evita usar tarjeta de crédito para cash advances',
                    'Compara tasas de interés entre diferentes emisores',
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
                    'Educa a todos en casa sobre este hábito',
                    'Usa temporizadores para aparatos que se olvidan encendidos',
                    'Desconecta electrodomésticos durante vacaciones',
                    'Identifica los "vampiros energéticos" de tu hogar',
                ],
            ],
            [
                'titulo' => 'Usa focos LED.',
                'descripcion' => 'Gastan menos energía y duran más.',
                'subconsejos' => [
                    'Sustituye poco a poco los bombillos antiguos.',
                    'Elige focos con buena eficiencia energética.',
                    'Aunque son más caros, se recupera en la factura.',
                    'Calcula el ahorro anual cambiando a LED',
                    'Elige la temperatura de color adecuada para cada espacio',
                    'Aprovecha programas de reciclaje de bombillas viejas',
                    'Considera bombillas inteligentes con programación',
                ],
            ],
            [
                'titulo' => 'Elige electrodomésticos eficientes.',
                'descripcion' => 'Reducen el consumo mensual.',
                'subconsejos' => [
                    'Busca etiquetas de eficiencia energética.',
                    'Evita electrodomésticos viejos que consumen mucho.',
                    'Haz mantenimiento regular para que funcionen mejor.',
                    'Compara el consumo anual entre modelos similares',
                    'Considera el tamaño adecuado para tus necesidades',
                    'Busca electrodomésticos con modo eco o ahorro',
                    'Calcula el retorno de inversión por ahorro energético',
                ],
            ],
            [
                'titulo' => 'Modera el uso de aire acondicionado y calefacción.',
                'descripcion' => 'Son de los aparatos que más consumen.',
                'subconsejos' => [
                    'Ajusta a temperaturas moderadas.',
                    'Limpia filtros con frecuencia.',
                    'Usa ventiladores o ropa adecuada como alternativa.',
                    'Programa termostatos para ajustarse automáticamente',
                    'Sella ventanas y puertas para evitar fugas térmicas',
                    'Usa cortinas térmicas en épocas de extremo calor/frío',
                    'Mantén equipos con mantenimiento profesional anual',
                ],
            ],
            [
                'titulo' => 'Repara fugas de agua.',
                'descripcion' => 'Una fuga pequeña puede aumentar bastante la factura.',
                'subconsejos' => [
                    'Revisa llaves y tuberías.',
                    'Cambia empaques o piezas dañadas.',
                    'Cierra bien grifos después de usarlos.',
                    'Instala reductores de flujo en griferías',
                    'Revisa el contador de agua periódicamente',
                    'Detecta fugas en inodoros con colorante alimentario',
                    'Considera sistemas de recolección de agua de lluvia',
                ],
            ],
            [
                'titulo' => 'Usa lavadora y lavavajillas con cargas completas.',
                'descripcion' => 'Ahorras agua y electricidad.',
                'subconsejos' => [
                    'Junta suficiente ropa antes de lavar.',
                    'Usa programas cortos o de bajo consumo.',
                    'Prefiere agua fría cuando sea posible.',
                    'Limpia regularmente los filtros de los aparatos',
                    'Usa la cantidad correcta de detergente',
                    'Considera horarios con tarifas eléctricas más bajas',
                    'Seca la ropa al aire libre cuando sea posible',
                ],
            ],
            [
                'titulo' => 'Instala temporizadores o sensores de luz.',
                'descripcion' => 'Se encienden solo cuando es necesario.',
                'subconsejos' => [
                    'Útiles en pasillos, patios y exteriores.',
                    'Evitan que las luces se queden encendidas por descuido.',
                    'Hay opciones económicas fáciles de instalar.',
                    'Ajusta la sensibilidad según la necesidad',
                    'Combina con tecnología solar para exteriores',
                    'Programa horarios según temporadas del año',
                    'Integra con sistemas de domótica para mayor control',
                ],
            ],
            [
                'titulo' => 'Aprovecha la luz natural.',
                'descripcion' => 'Reduce la necesidad de encender focos.',
                'subconsejos' => [
                    'Abre cortinas durante el día.',
                    'Usa colores claros en paredes para reflejar la luz.',
                    'Organiza tu espacio de trabajo cerca de ventanas.',
                    'Considera claraboyas o tubos de luz en espacios oscuros',
                    'Usa espejos estratégicamente para reflejar luz natural',
                    'Mantén ventanas limpias para máximo aprovechamiento',
                    'Planifica la decoración para optimizar la luminosidad',
                ],
            ],
            [
                'titulo' => 'Mantén puertas y ventanas bien cerradas.',
                'descripcion' => 'Conservas la temperatura interior y reduces consumo.',
                'subconsejos' => [
                    'Coloca burletes en puertas y ventanas.',
                    'Evita filtraciones de aire.',
                    'Aprovecha cortinas gruesas para mantener calor o frío.',
                    'Realiza auditorías energéticas para detectar fugas',
                    'Usa masilla o sellante en grietas y rendijas',
                    'Considera doble acristalamiento en climas extremos',
                    'Instala persianas aislantes en ventanas grandes',
                ],
            ],
            [
                'titulo' => 'Compara tarifas de servicios.',
                'descripcion' => 'Puedes estar pagando más de lo necesario.',
                'subconsejos' => [
                    'Revisa opciones de planes de energía o internet.',
                    'Ajusta el plan según tus necesidades reales.',
                    'Cambia de proveedor si otro ofrece mejores beneficios.',
                    'Negocia con tu proveedor actual mejores tarifas',
                    'Considera planes de pago anual con descuento',
                    'Revisa facturas detalladamente para cargos no reconocidos',
                    'Usa comparadores online de servicios públicos',
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
                    'Establece metas SMART (específicas, medibles, etc.)',
                    'Visualiza cómo te sentirás al alcanzar cada meta',
                    'Crea un tablero de visión con tus objetivos',
                    'Comparte tus metas con alguien que te apoye',
                ],
            ],
            [
                'titulo' => 'Ponle plazo a cada meta.',
                'descripcion' => 'Tener fecha límite te mantiene enfocada.',
                'subconsejos' => [
                    'Define una meta a corto plazo y otra a largo plazo.',
                    'Usa un calendario para llevar control.',
                    'Ajusta fechas si hay imprevistos.',
                    'Celebra hitos intermedios en metas largas',
                    'Usa apps de seguimiento de metas financieras',
                    'Revisa plazos trimestralmente y ajusta si es necesario',
                    'Establece recordatorios automáticos para revisar progreso',
                ],
            ],
            [
                'titulo' => 'Automatiza el ahorro.',
                'descripcion' => 'Para que no dependas de la fuerza de voluntad.',
                'subconsejos' => [
                    'Programa transferencias automáticas en tu banco.',
                    'Separa tu ahorro apenas recibas tu sueldo.',
                    'Considera ese dinero como intocable.',
                    'Usa apps de round-up que redondean tus compras',
                    'Configura ahorros recurrentes con aumento progresivo',
                    'Establece transferencias automáticas a cuentas separadas',
                    'Aprovecha herramientas de banca automática',
                ],
            ],
            [
                'titulo' => 'Prioriza tus metas.',
                'descripcion' => 'No todas tienen la misma urgencia.',
                'subconsejos' => [
                    'Primero ahorro para emergencias.',
                    'Después metas de educación o salud.',
                    'Finalmente metas de ocio o viajes.',
                    'Crea una jerarquía de necesidades financieras',
                    'Reevalúa prioridades según cambios de vida',
                    'Asigna porcentajes de ingreso a cada tipo de meta',
                    'Equilibra entre metas a corto, mediano y largo plazo',
                ],
            ],
            [
                'titulo' => 'Celebra logros pequeños.',
                'descripcion' => 'Te motiva a seguir ahorrando.',
                'subconsejos' => [
                    'Regálate algo simbólico al cumplir una parte.',
                    'Comparte tu progreso con alguien de confianza.',
                    'Refuerza la disciplina con recompensas sanas.',
                    'Crea un sistema de recompensas no monetarias',
                    'Documenta tus logros en un diario de ahorro',
                    'Comparte tus éxitos en comunidades de ahorro',
                    'Visualiza el progreso con gráficos o métricas',
                ],
            ],
            [
                'titulo' => 'Revisa tu progreso regularmente.',
                'descripcion' => 'Mantén el control para no desviarte.',
                'subconsejos' => [
                    'Hazlo cada semana o mes.',
                    'Usa tablas o gráficos para ver avances.',
                    'Ajusta montos si cambian tus ingresos.',
                    'Establece días fijos para revisión financiera',
                    'Utiliza plantillas de seguimiento de metas',
                    'Analiza desviaciones y ajusta estrategias',
                    'Compara progreso con períodos anteriores',
                ],
            ],
            [
                'titulo' => 'Evita tocar el dinero de la meta.',
                'descripcion' => 'Si lo usas, pierdes el ritmo.',
                'subconsejos' => [
                    'Guárdalo en una cuenta separada.',
                    'Usa alcancías digitales o físicas.',
                    'Activa bloqueos en apps para no retirarlo fácil.',
                    'Establece penalizaciones simbólicas por retiros anticipados',
                    'Crea barreras psicológicas considerando el dinero "sagrado"',
                    'Usa cuentas con restricciones de retiro',
                    'Automátiza reinversiones para dificultar el acceso',
                ],
            ],
            [
                'titulo' => 'Ajusta metas según tu situación.',
                'descripcion' => 'No siempre todo sale como lo planeaste.',
                'subconsejos' => [
                    'Si tus ingresos bajan, reduce montos pero no abandones la meta.',
                    'Si suben, incrementa el ahorro.',
                    'Sé flexible, pero constante.',
                    'Revisa metas ante cambios laborales o familiares',
                    'Crea metas escalonadas según capacidad económica',
                    'Establece mínimos no negociables para cada meta',
                    'Aprende a diferenciar entre ajuste y abandono de metas',
                ],
            ],
            [
                'titulo' => 'Visualiza tu meta.',
                'descripcion' => 'Verla te mantiene motivada.',
                'subconsejos' => [
                    'Haz un tablero con fotos de lo que quieres.',
                    'Marca cada avance en un gráfico.',
                    'Lleva un registro visible en tu habitación.',
                    'Crea alertas visuales en tu espacio de trabajo',
                    'Usa fondos de pantalla relacionados con tu meta',
                    'Visualiza diariamente el beneficio de alcanzar tu objetivo',
                    'Crea un símbolo físico que represente tu meta',
                ],
            ],
            [
                'titulo' => 'Separa metas por prioridad.',
                'descripcion' => 'Así aprovechas mejor tus ingresos.',
                'subconsejos' => [
                    'Identifica metas urgentes y no urgentes.',
                    'Destina un porcentaje a cada una.',
                    'Enfócate en cumplir una antes de empezar otra.',
                    'Clasifica en: supervivencia, seguridad, crecimiento',
                    'Revisa quarterly la clasificación de prioridades',
                    'Establece porcentajes de asignación según prioridad',
                    'Crea un sistema de colores para visualizar prioridades',
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
                    'Juegos de mesa educativos sobre finanzas',
                    'Asigna comisiones por tareas específicas',
                    'Enséñales a comparar precios en el supermercado',
                    'Crea metas de ahorro familiares para niños',
                ],
            ],
            [
                'titulo' => 'Planifiquen el presupuesto familiar juntos.',
                'descripcion' => 'Que todos participen aumenta el compromiso.',
                'subconsejos' => [
                    'Hagan una reunión mensual.',
                    'Revisen ingresos y gastos.',
                    'Propongan ideas para ahorrar.',
                    'Establezcan roles y responsabilidades financieras',
                    'Usen herramientas visuales para que todos entiendan',
                    'Incluyan a los niños según su edad y comprensión',
                    'Celebren los logros de ahorro en familia',
                ],
            ],
            [
                'titulo' => 'Hagan compras conjuntas.',
                'descripcion' => 'Comprar en grupo reduce costos.',
                'subconsejos' => [
                    'Compren al por mayor productos de la casa.',
                    'Dividan gastos de transporte.',
                    'Eviten duplicar cosas innecesarias.',
                    'Organicen rotación de compras entre familias',
                    'Crean un fondo común para compras al mayor',
                    'Coordinen listas de compra entre familias cercanas',
                    'Aprovechen membresías grupales en wholesalers',
                ],
            ],
            [
                'titulo' => 'Establezcan metas de ahorro familiares.',
                'descripcion' => 'Motiva más cuando el objetivo es compartido.',
                'subconsejos' => [
                    'Ahorrar para vacaciones en familia.',
                    'Mejorar la casa o comprar un electrodoméstico.',
                    'Definir montos y tiempos juntos.',
                    'Crear un tablero familiar de progreso de metas',
                    'Asignar contribuciones proporcionales según ingresos',
                    'Celebrar hitos intermedios con actividades familiares',
                    'Incluir metas individuales dentro del plan familiar',
                ],
            ],
            [
                'titulo' => 'Reduzcan gastos compartiendo recursos.',
                'descripcion' => 'Una buena organización evita derroches.',
                'subconsejos' => [
                    'Usen un solo servicio de streaming.',
                    'Compartan transporte o actividades.',
                    'Reutilicen y reciclen en casa.',
                    'Intercambien ropa y juguetes entre familias',
                    'Organicen bibliotecas comunitarias de libros',
                    'Compartan herramientas y equipos poco usados',
                    'Crean grupos de compra y trueque en la comunidad',
                ],
            ],
            [
                'titulo' => 'Realicen actividades recreativas económicas.',
                'descripcion' => 'No siempre es necesario gastar para divertirse.',
                'subconsejos' => [
                    'Juegos de mesa en casa.',
                    'Paseos al parque o caminatas.',
                    'Cocinar juntos en lugar de salir.',
                    'Noches de cine casero con palomitas hechas en casa',
                    'Intercambios de habilidades entre familiares',
                    'Visitas a museos en días de entrada gratuita',
                    'Crear tradiciones familiares low-cost',
                ],
            ],
            [
                'titulo' => 'Cree un fondo común para emergencias.',
                'descripcion' => 'Protege a toda la familia en momentos difíciles.',
                'subconsejos' => [
                    'Cada miembro aporta una cantidad fija.',
                    'Guárdenlo en una cuenta conjunta.',
                    'Úsenlo solo para emergencias reales.',
                    'Definan claramente qué constituye una emergencia',
                    'Establezcan un monto objetivo basado en gastos mensuales',
                    'Revisen y ajusten contribuciones regularmente',
                    'Mantengan el fondo en cuenta separada de uso diario',
                ],
            ],
            [
                'titulo' => 'Evalúen gastos familiares regularmente.',
                'descripcion' => 'Revisar juntos evita sorpresas.',
                'subconsejos' => [
                    'Revisen facturas y recibos.',
                    'Ajusten suscripciones o servicios.',
                    'Busquen alternativas más baratas.',
                    'Establezcan reuniones financieras familiares mensuales',
                    'Usen apps de presupuesto familiar colaborativas',
                    'Analicen tendencias de gasto trimestralmente',
                    'Celebren reducciones exitosas de gastos',
                ],
            ],
            [
                'titulo' => 'Promuevan hábitos de consumo responsable.',
                'descripcion' => 'Enseñar con el ejemplo es lo más efectivo.',
                'subconsejos' => [
                    'Eviten desperdiciar comida.',
                    'Apaguen luces y aparatos.',
                    'Cuiden el agua en casa.',
                    'Enseñen a reparar en lugar de reemplazar',
                    'Promuevan el consumo local y sostenible',
                    'Creen desafíos familiares de reducción de consumo',
                    'Compartan logros de consumo responsable con amigos',
                ],
            ],
            [
                'titulo' => 'Recompensen los logros en equipo.',
                'descripcion' => 'Alcanzar metas juntos fortalece la unión.',
                'subconsejos' => [
                    'Celebren cuando logren un objetivo de ahorro.',
                    'Organicen una actividad especial.',
                    'Refuercen la importancia de trabajar en conjunto.',
                    'Creen tradiciones de celebración low-cost',
                    'Reconozcan contribuciones individuales al éxito colectivo',
                    'Documenten los logros con fotos o videos familiares',
                    'Compartan sus éxitos con otras familias para inspirar',
                ],
            ],
        ];

        // --- PRESUPUESTOS ---
        $presupuesto = [
            [
                'titulo' => 'Registra todos tus ingresos y gastos.',
                'descripcion' => 'Conocer tus movimientos es el primer paso.',
                'subconsejos' => [
                    'Anótalos en una libreta o app.',
                    'Hazlo diariamente.',
                    'Clasifica cada gasto en una categoría.',
                    'Usa apps de budgeting con sincronización automática',
                    'Establece recordatorios para registro periódico',
                    'Guarda todos los comprobantes de compra',
                    'Revisa estados de cuenta bancarios regularmente',
                ],
            ],
            [
                'titulo' => 'Define un presupuesto mensual.',
                'descripcion' => 'Te ayudará a mantener tus finanzas bajo control.',
                'subconsejos' => [
                    'Establece un límite de gasto.',
                    'Incluye ahorro como una categoría.',
                    'Sé realista al definir los montos.',
                    'Basate en datos históricos de tus gastos',
                    'Incluye categorías para imprevistos',
                    'Revisa y ajusta el presupuesto cada trimestre',
                    'Usa el método de presupuesto de ceros',
                ],
            ],
            [
                'titulo' => 'Aplica la regla 50/30/20.',
                'descripcion' => 'Divide tus ingresos en necesidades, deseos y ahorro.',
                'subconsejos' => [
                    '50% necesidades.',
                    '30% deseos.',
                    '20% ahorro.',
                    'Ajusta porcentajes según tu realidad local',
                    'Incluye deudas en el porcentaje de necesidades',
                    'Automátiza las transferencias a cada categoría',
                    'Revisa quarterly si los porcentajes siguen siendo adecuados',
                ],
            ],
            [
                'titulo' => 'Separa gastos fijos de variables.',
                'descripcion' => 'Así podrás identificar qué puedes reducir.',
                'subconsejos' => [
                    'Renta, luz y agua son fijos.',
                    'Comidas fuera son variables.',
                    'Reduce lo variable primero.',
                    'Identifica gastos fijos que puedes negociar',
                    'Categoriza variables en esenciales y no esenciales',
                    'Establece topes mensuales para gastos variables',
                    'Analiza tendencias de gastos variables estacionales',
                ],
            ],
            [
                'titulo' => 'Usa sobres o cuentas separadas.',
                'descripcion' => 'Te ayuda a organizar mejor el dinero.',
                'subconsejos' => [
                    'Un sobre para cada categoría.',
                    'Evita mezclar dinero.',
                    'Usa cuentas digitales si es posible.',
                    'Automatiza transferencias a cuentas específicas',
                    'Usa apps de banca múltiple para mejor organización',
                    'Establece propósitos específicos para cada cuenta',
                    'Revisa regularmente los saldos de cada "sobre digital"',
                ],
            ],
            [
                'titulo' => 'Revisa tu presupuesto cada semana.',
                'descripcion' => 'Ajusta lo que sea necesario para no desviarte.',
                'subconsejos' => [
                    'Compara lo planeado vs lo real.',
                    'Corrige gastos innecesarios.',
                    'Ajusta montos si cambian tus ingresos.',
                    'Establece un día fijo para revisión semanal',
                    'Identifica patrones de gasto recurrentes',
                    'Celebra semanas donde te mantuviste dentro del presupuesto',
                    'Ajusta presupuestos futuros basado en aprendizajes',
                ],
            ],
            [
                'titulo' => 'Incluye un fondo de emergencias.',
                'descripcion' => 'Siempre habrá imprevistos.',
                'subconsejos' => [
                    'Ahorra al menos 3 meses de gastos.',
                    'Guárdalo en una cuenta de fácil acceso.',
                    'No lo uses salvo urgencias reales.',
                    'Calcula el monto basado en gastos esenciales',
                    'Automatiza contribuciones al fondo de emergencia',
                    'Revisa y ajusta el monto objetivo anualmente',
                    'Mantén el fondo en cuenta separada de otros ahorros',
                ],
            ],
            [
                'titulo' => 'Evita endeudarte más de lo necesario.',
                'descripcion' => 'Las deudas descontroladas arruinan el presupuesto.',
                'subconsejos' => [
                    'Usa crédito solo si puedes pagar.',
                    'Evita intereses altos.',
                    'Paga siempre a tiempo.',
                    'Calcula tu capacidad de endeudamiento real',
                    'Prioriza pago de deudas con intereses más altos',
                    'Considera consolidación de deudas si es necesario',
                    'Establece un plan de pago de deudas realista',
                ],
            ],
            [
                'titulo' => 'Prioriza tus gastos esenciales.',
                'descripcion' => 'Lo básico debe ir primero.',
                'subconsejos' => [
                    'Vivienda, comida y salud.',
                    'Después educación y transporte.',
                    'El ocio debe ir al final.',
                    'Crea una lista jerarquizada de necesidades',
                    'Asegura el pago de essentials antes que discrecionales',
                    'Reevalúa quarterly qué consideras "esencial"',
                    'Establece topes máximos para gastos no esenciales',
                ],
            ],
            [
                'titulo' => 'Destina parte a objetivos de largo plazo.',
                'descripcion' => 'Un buen presupuesto mira al futuro.',
                'subconsejos' => [
                    'Incluye metas de estudios.',
                    'Piensa en comprar una casa.',
                    'Ahorra para la jubilación.',
                    'Automatiza aportes a inversiones de largo plazo',
                    'Considera instrumentos de inversión adecuados a cada plazo',
                    'Revisa y rebalancea tus inversiones anualmente',
                    'Diversifica entre diferentes vehículos de inversión',
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