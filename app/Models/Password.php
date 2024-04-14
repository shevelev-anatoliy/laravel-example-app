<?php

namespace App\Models;

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
}
