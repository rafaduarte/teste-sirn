<?php

namespace App\Mail\mensagem;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class tenantMensagemSemAnexo extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $datas;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($datas)
    {
        $this->datas = $datas;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject($this->datas['assunto'])
        ->view('admin.email.mensagens.tenant.mensagem');

        return $this;
    }
}
