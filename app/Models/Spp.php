<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spp extends Model
{
    use HasFactory;

    public function gradeUser()
    {
        return $this->belongsTo(GradeUser::class);
    }

    public function paymentHistory()
    {
        return $this->belongsTo(PaymentHistory::class);
    }
}
