<?php

namespace App\Livewire\User\Settings\Email;

use App\Enums\Email\EmailStatusEnum;
use App\Models\Email;
use App\Models\User;
use App\Notifications\Email\ConfirmEmailNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Computed;
use Livewire\Component;

/**
 * @property User $user
 */
class UpdateEmailComponent extends Component
{
    private array $steps = ['start', 'confirm'];

    public string $step = 'start';

    public string $email = '';

    public string $uuid = '';

    public string $code = '';

    public function render()
    {
        return view('livewire.user.settings.email.update-email-component');
    }

    #[Computed()]
    public function user(): User
    {
        return Auth::user();
    }

    public function startEmail(): void
    {
        $this->validate([
            'email' => ['required', 'string', 'email', 'unique:users'],
        ]);

        $email = Email::query()->create([
            'value' => $this->email,
            'user_id' => $this->user->id,
            'status' => EmailStatusEnum::pending,
        ]);

        $this->uuid = $email->uuid;

        $notification = new ConfirmEmailNotification($email);
        $notification->withouLink();

        $this->user->notify($notification);

        $this->setStep('confirm');
    }

    public function confirmEmail()
    {
        $this->validate(['code' => ['required', 'string']]);

        /** @var Email */
        $email = Email::query()
            ->where('uuid', $this->uuid)
            ->where('user_id', $this->user->id)
            ->where('status', EmailStatusEnum::pending)
            ->first();

        if (is_null($email)) {
            throw ValidationException::withMessages([
                'code' => ['Заявка не найдена.'],
            ]);
        }

        if ($email->code !== $this->code) {
            throw ValidationException::withMessages([
                'code' => ['Неверный код.'],
            ]);
        }

        $this->user->updateEmail($email->value);
        $email->complete();

        return $this->redirectRoute(
            name: 'user.settings',
            navigate: true,
        );
    }

    public function setStep(string $step): void
    {
        if (in_array($step, $this->steps)) {
            $this->step = $step;
        }
    }
}
