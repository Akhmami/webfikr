<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Billing extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'biller_id',
        'trx_id',
        'customer_name',
        'virtual_account',
        'trx_amount',
        'billing_type',
        'is_paid',
        'description',
        'spp_pay_month',
        'use_balance',
        'datetime_expired',
        'is_balance'
    ];

    // protected $casts = [
    //     'datetime_expired' => 'datetime',
    // ];

    protected $dates = [
        'datetime_expired'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function biller()
    {
        return $this->belongsTo(Biller::class);
    }

    public function paymentHistories()
    {
        return $this->morphMany(PaymentHistory::class, 'payment_history');
    }

    public function scopeActive($query)
    {
        return $query->where('datetime_expired', '>=', Carbon::now())
            ->where('is_paid', 'N');
    }

    public function scopeInActive($query)
    {
        return $query->where('datetime_expired', '<=', Carbon::now())
            ->orWhere('is_paid', 'Y');
    }

    public function scopePaid($query)
    {
        return $query->where('is_paid', 'Y');
    }

    public function getDateExpiredAttribute($value)
    {
        return tanggal(date('Y-m-d', strtotime($this->datetime_expired))) . ' ' . date('H:i', strtotime($this->datetime_expired));
    }

    public function getFullVirtualAccountAttribute()
    {
        if (!empty($this->virtual_account)) {
            return config('bsi.bpi_code') . config('bsi.institute_code') . ' ' . $this->virtual_account;
        }
        return null;
    }
}
