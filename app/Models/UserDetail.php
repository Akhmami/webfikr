<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_pendaftaran',
        'nis',
        'nisn',
        'nik',
        'jenjang',
        'angkatan',
        'jurusan_pilihan',
        'jurusan',
        'jenis_pendaftaran',
        'asal_sekolah',
        'npsn',
        'alamat_asal_sekolah',
        'hp_asal_sekolah',
        'alasan_pindah',
        'negara',
        'anak_ke',
        'jml_saudara',
        'alamat',
        'provinsi',
        'kota',
        'kecamatan',
        'kelurahan',
        'nama_ayah',
        'nama_ibu',
        'jalur_masuk',
        'tahun_pendaftaran',
        'tahun_ajaran',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }
}
