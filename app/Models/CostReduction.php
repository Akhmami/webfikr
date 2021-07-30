<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CostReduction extends Model
{
    use HasFactory;

    protected $fillable = [
        'nominal',
        'keterangan',
        'is_used'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeUsed($query)
    {
        return $query->where('is_used', 'Y');
    }

    public function scopeUnused($query)
    {
        return $query->where('is_used', 'N');
    }
}
