<?php

namespace App\Notifications\proedi\user\email;

use App\Models\proedi\Proedi as ProediProedi;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class proedi extends Notification implements ShouldQueue
{
    use Queueable;

    private $proedii;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(ProediProedi $proedii)
    {
        $this->proedii = $proedii;
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
                    ->subject('Você foi Cadastrado no PROEDI')
                    ->greeting('Olá')
                    ->line('Parabéns por ter aderido ao PROEDI')
                    ->action('Acessar Dashboard no SIRN', url('/admin/empresa/proedi'))
                    ->line('Coordenadoria de Desenvolvimento Indústria(CODIT)');
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
