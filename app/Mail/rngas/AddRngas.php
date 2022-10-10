<?php

namespace App\Mail\rngas;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AddRngas extends Mailable implements ShouldQueue
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
        $this->subject('RN Mais Gás')
        ->view('admin.email.rngas.rngas.add_rngas');

        return $this;
    }
}
