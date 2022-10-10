<?php

namespace App\Mail\proedi\revisao;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PermitirEdicaoRevisao extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $pedido;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pedido)
    {
        $this->pedido = $pedido;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject('Autorização Para Editar')
        ->view('admin.email.proedi.revisao.autorizar_edicao_revisao');

        return $this;
    }
}
