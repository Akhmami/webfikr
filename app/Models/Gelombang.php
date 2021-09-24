<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gelombang extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'tgl_tes',
        'tgl_wawancara',
        'tgl_pengumuman',
        'batas_pembayaran',
        'biaya_pendaftaran',
        'deskripsi',
        'is_active',
        'datetime_expired'
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', 'Y');
    }
}
