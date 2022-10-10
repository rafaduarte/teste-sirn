<?php

namespace App\Mail\proedi\concessao;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class permitirEdicao extends Mailable implements ShouldQueue
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
        ->view('admin.email.proedi.concessao.autorizar_edicao');

        return $this;
    }
}
