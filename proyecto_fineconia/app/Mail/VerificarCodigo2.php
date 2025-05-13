<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerificarCodigo2 extends Mailable
{
    use Queueable, SerializesModels;

    public $codigo;

    public function __construct($codigo)
    {
        $this->codigo = $codigo;
    }

    public function build()
    {
        return $this->subject('Código de verificación de contraseña')
                    ->view('VerificarCodigo2')
                    ->with([
                        'codigo' => $this->codigo,
                    ]);
    }
}
