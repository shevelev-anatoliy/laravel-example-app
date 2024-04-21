<?php

namespace App\Notifications\Email;

use App\Models\Email;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ConfirmEmailNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        private Email $email,
    ) {
    }

    public function via(User $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(User $notifiable): MailMessage
    {
        $url = app_url("email/{$this->email->uuid}");

        return (new MailMessage)
            ->subject('Подтверждение почты')
            ->greeting('Здравствуйте!')
            ->line('Для подтверждения почты нажмите на кнопку ниже:')
            ->action('Подтвердить почту', $url);
    }
}
