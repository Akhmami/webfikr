<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biller extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'cumulative_payment_amount',
        'type',
        'is_active',
        'qty_spp',
        'previous_spp_date',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function billerDetails()
    {
        return $this->hasMany(BillerDetail::class);
    }

    public function billings()
    {
        return $this->hasMany(Billing::class);
    }

    public function activeBillings()
    {
        return $this->billings()->active();
    }

    public function paymentHistories()
    {
        return $this->hasManyThrough(PaymentHistory::class, Billing::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 'Y');
    }
}
