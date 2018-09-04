<?php
namespace App\Notifications;

use Backpack\Base\app\Notifications\ResetPasswordNotification as ResetPasswordNotification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPassword extends ResetPasswordNotification
{
    /**
     * Build the mail representation of the notification.
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage())
            ->line([
                'Você está recebendo este e-mail porque recebemos uma solicitação de redefinição de senha para sua conta.',
                'Clique no botão abaixo para redefinir sua senha:',
            ])
            ->action('Redefinir Senha', url(config('backpack.base.route_prefix') . '/password/reset', $this->token))
            ->line('Se você não solicitou uma redefinição de senha, nenhuma outra ação será necessária.');
    }
}