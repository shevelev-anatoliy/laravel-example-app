<?php

namespace App\Models;

use App\Enums\Passwords\PasswordStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Password extends Model
{
    use HasFactory;

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

    public static function booted(): void
    {
        static::creating(function (Password $password) {
            $password->fill(['uuid' => uuid()]);
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function updateStatus(PasswordStatusEnum $status): bool
    {
        if ($this->status->is($status)) {
            return false;
        }

        return $this->update(compact('status'));
    }
}
