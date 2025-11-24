<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TerminoCondicion;

class TerminosCondicionesSeeder extends Seeder
{
    public function run()
    {
        TerminoCondicion::truncate(); // Limpia la tabla antes de insertar

        $secciones = [

            [
                'orden' => 1,
                'titulo' => 'Términos y Condiciones de Uso',
                'subtitulo' => 'Introducción',
                'contenido' =>
                "Al utilizar Fineconia, el usuario acepta los siguientes términos:",
            ],

            [
                'orden' => 2,
                'titulo' => '1. Uso de la Plataforma',
                'subtitulo' => null,
                'contenido' =>
                "Fineconia es una aplicación destinada a la gestión de finanzas personales: registro de
                gastos e ingresos, visualización de gráficos, metas de ahorro, historial de abonos,
                perfil y contenido educativo.
                
                El usuario se compromete a usar los servicios únicamente para fines personales y
                legales. ",
            ],

            [
                'orden' => 3,
                'titulo' => '2. Registro y Veracidad de la Información',
                'subtitulo' => null,
                'contenido' =>
                "El usuario debe proporcionar datos verídicos al registrarse.
                 
                Toda la información ingresada dentro de (gastos, ingresos, objetivos, datos de perfil)
                es responsabilidad del usuario.",
            ],

            [
                'orden' => 4,
                'titulo' => '3. Acceso y Autenticación',
                'subtitulo' => null,
                'contenido' =>
                "Cada usuario es responsable de proteger sus credenciales de acceso.
                
                Fineconia no se hace responsable por el uso indebido de la cuenta por terceros que
                hayan obtenido las credenciales por descuido del usuario.",
            ],

            [
                'orden' => 5,
                'titulo' => '4. Funcionalidades del Sistema',
                'subtitulo' => 'El usuario acepta que la plataforma:',
                'contenido' =>
                "Mostrará su saldo total con base en los registros ingresados.
                
                Gestionará metas de ahorro con fechas de inicio, fin y movimientos asociados.
                
                Podrá generar reportes y visualizar gráficos basados en sus gastos e ingresos.
                
                Permitirá acceder a guías de educación financiera provistas por Fineconia.",
            ],

            [
                'orden' => 6,
                'titulo' => '5. Disponibilidad del servicio',
                'subtitulo' => null,
                'contenido' =>
                "Fineconia procurará que los servicios estén disponibles de manera continua.
                
                No obstante, pueden ocurrir interrupciones por mantenimiento, actualizaciones o
                fallos técnicos.
                
                Fineconia no se responsabiliza por pérdidas derivadas de interrupciones externas o
                conexiones inestables del usuario.",
            ],

            [
                'orden' => 7,
                'titulo' => '6. Privacidad y Protección de Datos',
                'subtitulo' => null,
                'contenido' =>
                "El uso de la plataforma implica la aceptación de la Política de Seguridad y del manejo
                de datos descrito.
                
                La información del usuario será tratada conforme a normas de privacidad establecidas
                en el país.",
            ],

            [
                'orden' => 8,
                'titulo' => '7. Contenido Educativo',
                'subtitulo' => null,
                'contenido' =>
                "Las guías de educación financiera ofrecidas tienen fines informativos.
                
                Fineconia no garantiza que la información constituya asesoría financiera profesional.",
            ],

            [
                'orden' => 9,
                'titulo' => '8. Limites de Responsabilidad',
                'subtitulo' => 'Fineconia no sera responsable por:',
                'contenido' =>
                "Cálculos incorrectos resultantes de datos mal ingresados por el usuario.

                Pérdidas económicas derivadas del uso de la información registrada en la app.

                Fallas del dispositivo del usuario o accesos no autorizados por mal manejo de
                credenciales.",
            ],

            [
                'orden' => 10,
                'titulo' => '9. Modificaciones',
                'subtitulo' => null,
                'contenido' =>
                "Fineconia se reserva el derecho de modificar estos términos.
                
                Los cambios serán informados al usuario y el uso continuo de la app implica su
                aceptación.",
            ],
        ];

        foreach ($secciones as $sec) {
            TerminoCondicion::create($sec);
        }
    }
}
