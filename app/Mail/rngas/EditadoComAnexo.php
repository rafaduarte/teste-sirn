<?php

namespace App\Mail\rngas;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EditadoComAnexo extends Mailable implements ShouldQueue
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
        $this->subject('Pedido de Concessão Editado')
        ->view('admin.email.rngas.concessao.pedido_editado_anexo');

        foreach($this->datas['files_one'] as $file_one){
            $this->attach(storage_path($file_one));
        }

        foreach($this->datas['files_two'] as $file_two){
            $this->attach(storage_path($file_two));
        }

        foreach($this->datas['files'] as $file){
            $this->attach(storage_path($file));
        }        
                
        return $this;
    }
}
