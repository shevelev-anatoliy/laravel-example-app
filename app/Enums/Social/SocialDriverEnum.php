<?php

namespace App\Enums\Social;

enum SocialDriverEnum: string
{
    case github = 'github';
    case vkontakte = 'vkontakte';
    case telegram = 'telegram';
    case google = 'google';
}
