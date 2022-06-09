<?php

namespace App\Actions\Migrate;

use App\Models\UserDetail;
use App\Models\Parent;

class MoveToParentTable
{
    public function migrate()
    {
        $userDetails = UserDetail::cursor();
        foreach ($userDetails as $user) {
            $mobile = $user->user()->mobilePhones()
                ->where('is_first', 'Y')
                ->first();

            $mobileAyah = $user->user()->mobilePhones()
                ->where('name', 'LIKE', "%{$user->nama_ayah}%")
                ->first();

            $mobileIbu = $user->user()->mobilePhones()
                ->where('name', 'LIKE', "%{$user->nama_ibu}%")
                ->first();

            Parent::createMany([
                [
                    'user_id' => $user->user_id,
                    'nama' => $user->nama_ayah,
                    'tanggal_lahir' => $user->tanggal_lahir_ayah,
                    'pendidikan' => $user->pendidikan_ayah,
                    'pekerjaan' => $user->pekerjaan_ayah,
                    'penghasilan' => $user->penghasilan_ayah,
                    'tempat_kerja' => $user->tempat_kerja_ayah,
                    'pendidikan_agama' => $user->pendidikan_agama_ayah,
                    'baca_quran' => $user->baca_quran_ayah,
                    'haji_umroh' => $user->haji_umroh_ayah,
                    'organisasi_islam' => $user->organisasi_islam_ayah,
                    'buku_bacaan_islam' => $user->buku_bacaan_islam_ayah,
                    'phone_number' => $mobileAyah->full_number ?? $mobile->full_number,
                    'is_first_number' => 'N',
                    'type' => 'ayah'
                ],
                [
                    'user_id' => $user->user_id,
                    'nama' => $user->nama_ibu,
                    'tanggal_lahir' => $user->tanggal_lahir_ibu,
                    'pendidikan' => $user->pendidikan_ibu,
                    'pekerjaan' => $user->pekerjaan_ibu,
                    'penghasilan' => $user->penghasilan_ibu,
                    'tempat_kerja' => $user->tempat_kerja_ibu,
                    'pendidikan_agama' => $user->pendidikan_agama_ibu,
                    'baca_quran' => $user->baca_quran_ibu,
                    'haji_umroh' => $user->haji_umroh_ibu,
                    'organisasi_islam' => $user->organisasi_islam_ibu,
                    'buku_bacaan_islam' => $user->buku_bacaan_islam_ibu,
                    'phone_number' => $mobileIbu->full_number ?? $mobile->full_number,
                    'is_first_number' => 'Y',
                    'type' => 'ibu'
                ]
            ]);
        }
    }
}
