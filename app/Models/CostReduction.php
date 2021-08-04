<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CostReduction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nominal',
        'keterangan',
        'is_used',
        'type'
    ];

    public function billerDetail()
    {
        return $this->belongsTo(BillerDetail::class);
    }

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
