<?php

namespace App\Mail\rngas;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PedirEdicaoConcessao extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $pedido;

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
        $this->subject('Autorização Para Editar Pedido Concessão do RN Mais Gás')
        ->view('admin.email.rngas.concessao.atualizar_pedido');

        return $this;
    }
}
