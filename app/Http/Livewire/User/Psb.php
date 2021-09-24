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
            'billerPsb', 'gelombang'
        ])->findOrFail(auth()->id());

        $status_psb = $user->statusPsb;
        $lokasi_tes = $user->lokasiTest;
        $tes_kesehatan = $user->medicalCheck;
        $billing = $user->billerPsb->billing;
        $gel = $user->gelombang;

        $vars = array(
            '{nama}' => $user->name ?? null,
            '{no_pendaftaran}' => $user->userDetail->no_pendaftaran ?? null,
            '{va_psb}' => config('bsi.first_va_number') . ($billing->virtual_account ?? null),
            '{tagihan_psb}' => rupiah($billing->trx_amount ?? 0),
            '{tahun_pendaftaran}' => $user->tahun_pendaftaran ?? null,
            '{deskripsi_lokasi_tes}' => $lokasi_tes->deskripsi ?? null,
            '{deskripsi_tes_kesehatan}' => $tes_kesehatan->description ?? null,
            '{tgl_tes}' => $gel->tgl_tes ?? null,
            '{tgl_pengumuman}' => $gel->tgl_pengumuman ?? null,
            '{tgl_wawancara}' => $gel->tgl_wawancara ?? null,
            '{batas_pembayaran_dupsb}' => $gel->batas_pembayaran ?? null,

        );

        $data['description'] = strtr($status_psb->description, $vars);

        return view('livewire.user.psb', [
            'data' => $data
        ]);
    }
}
