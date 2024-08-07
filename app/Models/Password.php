<?php

namespace App\Models;

use App\Enums\Passwords\PasswordStatusEnum;
use App\Traits\BelongsToUser;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Password extends Model
{
    use BelongsToUser;
    use HasFactory;
    use HasUuid;

    protected $fillable = [
        'uuid',
        'email',
        'user_id',
        'status',
        'ip',
    ];

    protected function casts(): array
    {
        return [
            'status' => PasswordStatusEnum::class,
        ];
    }

    public function updateStatus(PasswordStatusEnum $status): bool
    {
        if ($this->status->is($status)) {
            return false;
        }

        return $this->update(compact('status'));
    }
}
