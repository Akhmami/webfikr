<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    use HasFactory;

    protected $fillable = [
        'trx_id',
        'virtual_account',
        'payment_amount',
        'is_paid',
        'datetime_expired',
    ];

    public function paymentHistories()
    {
        return $this->morphMany(PaymentHistory::class, 'payment_history');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
