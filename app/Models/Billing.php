<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'trx_id',
        'virtual_account',
        'amount',
        'cumulative_payment_amount',
        'billing_type',
        'type',
        'status',
        'description',
        'datetime_expired'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function billingDetails()
    {
        return $this->hasMany(BillingDetail::class);
    }

    public function paymentHistories()
    {
        return $this->hasMany(PaymentHistory::class);
    }
}
