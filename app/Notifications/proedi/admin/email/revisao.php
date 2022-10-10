<?php

namespace App\Notifications\proedi\admin\email;

use App\Models\proedi\PedirRevisaoProedi as RevisaoProedi;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class revisao extends Notification implements ShouldQueue
{
    use Queueable;

    private $revisaoo;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(RevisaoProedi $revisao)
    {
        $this->revisaoo = $revisao;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
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
                    ->subject('Pedido de revisão do PROEDI')
                    ->greeting('Olá')
                    ->line("A empresa {$this->revisaoo->social_name} solicitou revisão do PROEDI")
                    ->action('Acessar dashboard do SIRN', url('/admin/proedi'))
                    ->line('Sistema Unificado de Incentivos às indústrias do RN(SIRN)');
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

    /**
     * Get the Database representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'revisaoo' => $this->revisaoo,
        ];
    }
}
