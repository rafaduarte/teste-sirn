<?php

namespace App\Mail\proedi\relatorio;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PedirEdicaoQuartoRelatorio extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $relatorio;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($relatorio)
    {
        $this->relatorio = $relatorio;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject('Autorização Para Editar')
        ->view('admin.email.proedi.relatorio.pedir_edicao_quarto_relatorio');

        return $this;
    }
}
