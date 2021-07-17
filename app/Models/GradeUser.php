<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradeUser extends Model
{
    use HasFactory;

    protected $table = 'grade_user';

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function spps()
    {
        return $this->hasMany(Spp::class);
    }

    public function latestSpp()
    {
        return $this->hasOne(Spp::class)->latestOfMany()->withDefault();
    }
}
