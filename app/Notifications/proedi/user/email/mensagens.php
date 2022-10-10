<?php

namespace App\Notifications\proedi\user\email;

use App\Models\Mensagens\tenantMensagem;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class mensagens extends Notification implements ShouldQueue
{
    use Queueable;

    private $mensagens;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(tenantMensagem $mensagem)
    {
        $this->mensagens = $mensagem;
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
                    ->subject("{$this->mensagens->assunto}")
                    ->greeting('Olá')
                    ->line("{$this->mensagens->mensagem}")
                    ->action('Visualizar mensagem no SIRN', url('/admin/mensagem'))
                    ->line('Coordenadoria de Desenvolvimento Indústrial(CODIT)');
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
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            
            'mensagens' => $this->mensagens,
        ];
    }
}
