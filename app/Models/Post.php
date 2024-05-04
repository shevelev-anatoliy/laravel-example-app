<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use MoonShine\ChangeLog\Traits\HasChangeLog;

class Post extends Model
{
    use HasFactory;
    use HasChangeLog;

    public $fillable = [
        'title', 'content',
    ];
}
