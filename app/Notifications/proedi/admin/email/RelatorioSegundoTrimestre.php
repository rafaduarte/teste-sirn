<?php

namespace App\Notifications\proedi\admin\email;

use App\Models\proedi\EnviarRelatorioSegundoTrimestre;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RelatorioSegundoTrimestre extends Notification implements ShouldQueue
{
    use Queueable;

    private $enviarRelatorio;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(EnviarRelatorioSegundoTrimestre $enviarRelatorio)
    {
        $this->enviarRelatorio = $enviarRelatorio;
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
        ->subject('Relatório do PROEDI enviado por uma Empresa')
        ->greeting('Olá')
        ->line("A empresa {$this->enviarRelatorio->nome_fantasia} enviou relatório do PROEDI")
        ->action('Visualizar no SIRN', url('/admin/relatorio/proedi'))
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
            'enviarRelatorio' => $this->enviarRelatorio,
        ];
    }
}
