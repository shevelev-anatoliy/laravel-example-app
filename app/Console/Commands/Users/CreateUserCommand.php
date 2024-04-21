<?php

namespace App\Console\Commands\Users;

use App\Models\User;
use Illuminate\Console\Command;

class CreateUserCommand extends Command
{
    protected $signature = 'users:create';

    public function handle()
    {
        $user = new User();
        $user->first_name = $this->ask('Имя', 'Test');
        $user->email = $this->ask('Email', 'tolik.breathless@gmail.com');
        $user->email_confirmed_at = now();
        $user->password = $this->ask('Пароль', 'Qwerty_123');
        $user->save();

        $this->info('Пользователь создан');
    }
}
