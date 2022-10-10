<?php

namespace App\Mail\proedi\relatorio;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AtualizarRelatorioProediPrimeiroSemAnexo extends Mailable implements ShouldQueue
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
        $this->subject('Relatório Atualizado')
        ->view('admin.email.proedi.relatorio.atualizar_relatorio_primeiro');
                        
        return $this;
    }
}
