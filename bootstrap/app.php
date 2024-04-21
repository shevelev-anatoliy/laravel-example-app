<?php

use App\Console\Commands\Passwords\ExpirePasswordsCommand;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
    )
    ->withSchedule(function (Schedule $schedule) {
        $schedule->command(ExpirePasswordsCommand::class)->hourly();
    })
    ->withMiddleware(function (Middleware $middleware) {
        $middleware
            ->redirectUsersTo('user')
            ->alias([
                'online' => \App\Http\Middleware\OnlineMiddleware::class,
            ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
