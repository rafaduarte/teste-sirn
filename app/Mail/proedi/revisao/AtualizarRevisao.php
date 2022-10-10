<?php

namespace App\Mail\proedi\revisao;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AtualizarRevisao extends Mailable implements ShouldQueue
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
        $this->subject('Autorização Para Editar')
        ->view('admin.email.proedi.revisao.atualizar_pedido');

        foreach($this->datas['files'] as $file){
           $this->attach(storage_path($file));
        }
                
        return $this;
    }
}
