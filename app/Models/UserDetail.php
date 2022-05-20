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
        'tanggal_lahir_ayah',
        'pendidikan_ayah',
        'pekerjaan_ayah',
        'penghasilan_ayah',
        'tempat_kerja_ayah',
        'pendidikan_agama_ayah',
        'baca_quran_ayah',
        'haji_umroh_ayah',
        'organisasi_islam_ayah',
        'buku_bacaan_islam_ayah',
        'nama_ibu',
        'tanggal_lahir_ibu',
        'pendidikan_ibu',
        'pekerjaan_ibu',
        'penghasilan_ibu',
        'tempat_kerja_ibu',
        'pendidikan_agama_ibu',
        'baca_quran_ibu',
        'haji_umroh_ibu',
        'organisasi_islam_ibu',
        'buku_bacaan_islam_ibu',
        'jalur_masuk',
        'tahun_pendaftaran',
        'tahun_ajaran',
        'status',
        'mutasi_kelas'
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
