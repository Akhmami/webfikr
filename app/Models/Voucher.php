<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'value',
        'quota',
        'datetime_expired'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function getAvailableAttribute()
    {
        return $this->quota - $this->users()->count();
    }

    public function getNominalAttribute()
    {
        if ($this->type === 'percent') {
            return $this->value * 100;
        }

        return $this->value;
    }
}
