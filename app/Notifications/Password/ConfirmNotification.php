<?php

namespace App\Notifications\Password;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ConfirmNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function via(User $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(User $notifiable): MailMessage
    {
        $url = app_url('/password/123/');

        return (new MailMessage)
            ->subject('Изменение пароля')
            ->greeting('Здравствуйте!')
            ->line('Для изменения пароля нажмите на кнопку ниже:')
            ->action('Изменить пароль', $url);
    }
}
