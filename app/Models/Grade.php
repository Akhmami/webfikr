<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'jenjang',
        'wali',
        'kapasitas'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function gradeUsers()
    {
        return $this->hasMany(GradeUser::class);
    }

    public function spps()
    {
        return $this->hasMany(Spp::class);
    }
}
