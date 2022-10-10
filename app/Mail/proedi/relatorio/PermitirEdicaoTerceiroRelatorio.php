<?php

namespace App\Mail\proedi\relatorio;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PermitirEdicaoTerceiroRelatorio extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $relatorio;

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
        ->view('admin.email.proedi.relatorio.autorizar_edicao_terceiro_relatorio');

        return $this;
    }
}
