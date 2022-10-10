<?php

namespace App\Notifications\rngas\user\email;

use App\Models\RnGas\RnGas as RnGasRnGas;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Rngas extends Notification implements ShouldQueue
{
    use Queueable;

    private $rngas;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(RnGasRnGas $rngas)
    {
        $this->rngas = $rngas;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Aprovação no RN Mais Gás.')
                    ->greeting("Olá, {$this->rngas->name}")
                    ->line("Parabéns pela aprovação no RN Mais Gás, o seu desconto do iCMS é de {$this->rngas->desconto}")                   
                    ->action('Acompanhar o seu cadastro no SIRN', url('http://sirn.test/admin/meu/rngas'))
                    ->line('• Em caso de dúvidas, a empresa poderá mandar um E-mail para o endereço: sedec.coditrn@gmail.com' );
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
