<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPagePost extends Model
{
    use HasFactory;

    protected $fillable = [
        'visible',
        'jenjang',
        'type',
        'gelombang',
        'except',
        'body',
        'pinned',
        'published_at'
    ];

    protected $casts = [
        'published_at' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
