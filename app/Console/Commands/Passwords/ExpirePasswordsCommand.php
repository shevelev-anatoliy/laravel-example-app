<?php

namespace App\Console\Commands\Passwords;

use App\Enums\Passwords\PasswordStatusEnum;
use App\Models\Password;
use Illuminate\Console\Command;

class ExpirePasswordsCommand extends Command
{
    protected $signature = 'passwords:expire';

    public function handle()
    {
        $this->warn('Просрачивание паролей...');

        $this->expirePasswords();

        $this->info('Пароли просрачены.');
    }

    private function expirePasswords(): void
    {
        // получить просроченые активные заявки
        // обновить их статусы на просроченные

        Password::query()
            ->where('status', PasswordStatusEnum::pending)
            ->where('created_at', '<=', now()->subHours(1))
            ->update(['status' => PasswordStatusEnum::expired]);
    }
}
