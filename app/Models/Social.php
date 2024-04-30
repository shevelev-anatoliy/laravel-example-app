<?php

namespace App\Models;

use App\Enums\Social\SocialDriverEnum;
use App\Traits\BelongsToUser;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    use BelongsToUser;
    use HasFactory;
    use HasUuid;

    protected $fillable = [
        'user_id',
        'driver', 'driver_user_id',
    ];

    protected function casts(): array
    {
        return [
            'driver' => SocialDriverEnum::class,
        ];
    }
}
