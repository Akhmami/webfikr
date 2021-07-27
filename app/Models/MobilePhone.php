<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MobilePhone extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'country_code',
        'number',
        'is_first'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFullNumberAttribute()
    {
        return $this->country_code . $this->number;
    }
}
