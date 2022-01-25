<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clothes extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama', 'ukuran', 'deskripsi'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
