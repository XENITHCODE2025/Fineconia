<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RecuperacionContrasenaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $codigo; // Declaramos la propiedad

    /**
     * Create a new message instance.
     */
    public function __construct($codigo)
    {
        $this->codigo = $codigo; // Asignamos el código recibido
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Tu código de recuperación - Fineconia')
            ->view('VerificarCodigo2') // Vista que ya tienes
            ->with(['codigo' => $this->codigo]);
    }
}