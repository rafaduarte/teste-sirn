<?php

namespace App\Notifications\proedi\admin\email;

use App\Http\Controllers\Proedi\PedirConcessaoController;
use App\Models\proedi\PedirConcessaoProedi;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class concessao extends Notification implements ShouldQueue
{
    use Queueable;

    private $concessaoo;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(PedirConcessaoProedi $pedirConcessao)
    {
        $this->concessaoo = $pedirConcessao;
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
                    ->subject('Pedido de concessão do PROEDI')
                    ->greeting('Olá')
                    ->line("A empresa {$this->concessaoo->nome_empresa} solicitou concessão do PROEDI")
                    ->action('Acessar dashboard do SIRN', url('/admin/proedi'))
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
     * Get the Database representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'concessaoo' => $this->concessaoo,
        ];
    }
}
