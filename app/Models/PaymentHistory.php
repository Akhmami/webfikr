<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class PaymentHistory extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'payment_ntb',
        'customer_name',
        'virtual_account',
        'payment_amount',
        'datetime_payment',
    ];

    protected $casts = [
        'datetime_payment' => 'datetime'
    ];

    public function user()
    {
        return $this->hasOneThrough(User::class, Billing::class);
    }

    public function paymentHistory()
    {
        return $this->morphTo();
    }

    public function spps()
    {
        return $this->hasMany(Spp::class);
    }

    public function getDateTimeAttribute($value)
    {
        return tanggal(date('Y-m-d', strtotime($this->datetime_payment))) . ' ' . date('H:i', strtotime($this->datetime_payment));
    }
}
