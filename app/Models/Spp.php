<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spp extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'grade_id',
        'payment_history_id',
        'bulan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function paymentHistory()
    {
        return $this->belongsTo(PaymentHistory::class);
    }
}
