<?php

use Illuminate\Support\Str;

function active_link(string $route, string $active = 'active', string $notActive = ''): string
{
    return request()->routeIs($route) ? $active : $notActive;
}

function app_url(string $path = ''): string
{
    return implode('/', array_filter([
        trim(config('app.url'), '/'),
        trim($path, '/'),
    ]));
}

function uuid(): string
{
    return (string) Str::uuid();
}

function code(): string
{
    return (string) random_int(100_000, 999_999);
}
