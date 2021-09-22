<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    use HasFactory;

    protected $fillable = [
        'periode',
        'is_active'
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', 'Y');
    }
}
