<?php

namespace App\Notifications\rngas\user\email;

use App\Models\RnGas\SeiRnGas as RnGasSeiRnGas;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SeiRngas extends Notification implements ShouldQueue
{
    use Queueable;

    private $sei;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(RnGasSeiRnGas $sei)
    {
        $this->sei = $sei;
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
                    ->subject('PROTOCOLO SEI Solicitação ao RN Mais Gás.')
                    ->greeting("Olá, {$this->sei->name}")
                    ->line("Informamos que seu pedido de concessão ao RN Mais Gás foi protocolado
                    sob o número SEI {$this->sei->numero} e encontra-se em análise na Secretaria de Estado
                    do Desenvolvimento Econômico do Rio Grande do Norte (SEDEC-RN).")
                    ->line('O andamento desse processo poderá ser consultado a qualquer momento
                    pelo acesso externo ao SEI através do link abaixo:')
                    ->action('Clique aqui para acompanhar o processo no sei', url('https://sei.rn.gov.br/sei/controlador_externo.php?acao=usuario_externo_logar&id_orgao_acesso_externo=0'))
                    ->line('• Caso a empresa não possua cadastra externo ao SEI poderá realiza-lo por meio do mesmo link.')
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
