<?php

function active_link(string $route, string $active = 'active', string $notActive = ''): string
{
    return request()->routeIs($route) ? $active : $notActive;
}
