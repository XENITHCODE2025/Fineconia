<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PoliticaSeguridad;

class PoliticasSeguridadSeeder extends Seeder
{
    public function run()
    {
        PoliticaSeguridad::truncate();

        $secciones = [

            [
                'orden' => 1,
                'titulo' => 'Política de Seguridad',
                'subtitulo' => null,
                'contenido' => 'Fineconia se compromete a proteger la información personal y financiera de cada usuario. Nuestro objetivo es garantizar la confidencialidad, integridad y disponibilidad de los datos almacenados en la plataforma.',
            ],

            [
                'orden' => 2,
                'titulo' => '1. Protección de Datos Personales',
                'subtitulo' => null,
                'contenido' => "Toda la información proporcionada por el usuario (nombre, correo y datos relacionados con su cuenta) es resguardada mediante protocolos de seguridad estándar de la industria.\n\nNingún dato personal será compartido con terceros sin consentimiento previo, salvo requerimientos legales.",
            ],

            [
                'orden' => 3,
                'titulo' => '2. Seguridad de la Información Financiera',
                'subtitulo' => null,
                'contenido' => "Los registros de gastos, ingresos, objetivos de ahorro, saldo y movimientos dentro de la aplicación se almacenan de forma cifrada.\n\nSolo el usuario autenticado puede acceder a su información financiera.\n\nEl sistema bloquea intentos no autorizados y monitorea accesos sospechosos.",
            ],

            [
                'orden' => 4,
                'titulo' => '3. Autenticación y Acceso',
                'subtitulo' => null,
                'contenido' => "El acceso a la plataforma se realiza únicamente mediante credenciales personales del usuario.\n\nFineconia recomienda el uso de contraseñas seguras y la actualización periódica de las mismas.",
            ],

            [
                'orden' => 5,
                'titulo' => '4. Integridad de los Datos',
                'subtitulo' => null,
                'contenido' => "La información guardada en la plataforma no puede ser alterada sin autorización.\n\nEl sistema valida que todas las transacciones y registros ingresados correspondan al usuario autenticado.",
            ],

            [
                'orden' => 6,
                'titulo' => '5. Almacenamiento y Respaldo',
                'subtitulo' => null,
                'contenido' => "Los datos son almacenados en servidores seguros con mecanismos de respaldo periódico.\n\nEn caso de fallos técnicos, el sistema cuenta con medidas para restaurar la información.",
            ],

            [
                'orden' => 7,
                'titulo' => '6. Actualizaciones de Seguridad',
                'subtitulo' => null,
                'contenido' => "Fineconia revisa y actualiza regularmente sus mecanismos de seguridad para prevenir vulnerabilidades.\n\nEl usuario será informado cuando se apliquen cambios relevantes que afecten su información.",
            ],

            [
                'orden' => 8,
                'titulo' => '7. Responsabilidad del Usuario',
                'subtitulo' => null,
                'contenido' => "El usuario es responsable de mantener en privado sus credenciales.\n\nFineconia no se responsabiliza por accesos realizados desde dispositivos comprometidos o compartidos.",
            ],

        ];

        foreach ($secciones as $sec) {
            PoliticaSeguridad::create($sec);
        }
    }
}
