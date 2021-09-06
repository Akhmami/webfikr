<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'last_amount',
        'type',
        'nominal',
        'current_amount',
        'description'
    ];

    public function paymentHistories()
    {
        return $this->morphMany(PaymentHistory::class, 'payment_history');
    }
}
