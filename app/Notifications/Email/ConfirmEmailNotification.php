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
        $url = app_url("email/{$this->email->uuid}/confirm?code={$this->email->code}");

        return (new MailMessage)
            ->subject('Подтверждение почты')
            ->greeting('Здравствуйте!')
            ->line("Введите код подтверждения: {$this->email->code}")
            ->line('Или нажмите на кнопку ниже:')
            ->action('Подтвердить почту', $url);
    }
}
