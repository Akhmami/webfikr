<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;

class Psb extends Component
{
    public function render()
    {
        $data = [];
        $user = User::with([
            'statusPsb', 'lokasiTest', 'medicalCheck',
            'billerPsb', 'gelombang', 'userDetail'
        ])->findOrFail(auth()->id());

        $status_psb = $user->statusPsb;
        $lokasi_tes = $user->lokasiTest;
        $tes_kesehatan = $user->medicalCheck;
        $billing = $user->billerPsb->billing;
        $gel = $user->gelombang;

        $smp = 'hidden';
        $sma = 'hidden';
        $internal = 'hidden';
        $eksternal = 'hidden';
        if ($user->userDetail->jenjang === 'SMP') {
            $smp = 'block';
        }

        if ($user->userDetail->jenjang === 'SMA') {
            $sma = 'block';
        }

        if ($user->userDetail->jenis_pendaftaran === 'internal') {
            $internal = 'block';
        }

        if ($user->userDetail->jenis_pendaftaran === 'eksternal') {
            $eksternal = 'block';
        }


        $vars = array(
            '{nama}' => $user->name ?? null,
            '{username}' => $user->username,
            '{no_pendaftaran}' => $user->userDetail->no_pendaftaran ?? null,
            '{jenjang}' => $user->userDetail->jenjang,
            '{jurusan}' => $user->userDetail->jurusan,
            '{va_psb}' => $billing->virtual_account ?? null,
            '{tagihan_psb}' => rupiah($billing->trx_amount ?? 0),
            '{tahun_pendaftaran}' => $user->tahun_pendaftaran ?? null,
            '{deskripsi_lokasi_tes}' => $lokasi_tes->deskripsi ?? null,
            '{deskripsi_tes_kesehatan}' => $tes_kesehatan->description ?? null,
            '{tgl_tes}' => $gel->tgl_tes ?? null,
            '{tgl_pengumuman}' => $gel->tgl_pengumuman ?? null,
            '{tgl_wawancara}' => $gel->tgl_wawancara ?? null,
            '{batas_pembayaran_dupsb}' => $gel->batas_pembayaran ?? null,
            '{if_smp}' => '<div class="' . $smp . '">',
            '{end_smp}' => '</div>',
            '{if_sma}' => '<div class="' . $sma . '">',
            '{end_sma}' => '</div>',
            '{if_internal}' => '<div class="' . $internal . '">',
            '{end_internal}' => '</div>',
            '{if_eksternal}' => '<div class="' . $eksternal . '">',
            '{end_eksternal}' => '</div>'
        );

        $data['description'] = strtr($status_psb->description, $vars);

        return view('livewire.user.psb', [
            'data' => $data
        ]);
    }
}
