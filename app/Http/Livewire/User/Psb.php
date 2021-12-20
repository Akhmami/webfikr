<?php

namespace App\Http\Livewire\User;

use Livewire\Component;

class Psb extends Component
{
    public function render()
    {
        $data = [];
        $user = auth()->user();
        $user->load([
            'statusPsb', 'lokasiTest', 'medicalCheck',
            'billerPsb', 'gelombang', 'userDetail'
        ]);

        $status_psb = $user->statusPsb;
        $lokasi_tes = $user->lokasiTest;
        $tes_kesehatan = $user->medicalCheck;
        $billingPsb = $user->billerPsb->billing ?? null;
        $billerDupsb = $user->billerDupsb ?? null;
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
            '{va_psb}' => $billingPsb->virtual_account ?? null,
            '{tagihan_psb}' => rupiah($billingPsb->trx_amount ?? 0),
            '{total_tagihan_dupsb}' => rupiah($billerDupsb->amount ?? 0),
            '{rincian_tagihan_dupsb}' => $this->billerDetailHtml($billerDupsb->billerDetails->pluck('nominal', 'nama') ?? null),
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
        $data['status_psb_id'] = $user->status_psb_id;
        $data['tgl_pengumuman'] = $gel->tgl_pengumuman;

        return view('livewire.user.psb', [
            'data' => $data
        ]);
    }

    public function billerDetailHtml($items)
    {
        $list = '';
        $total = 0;
        if (!empty($items)) {
            foreach ($items as $key => $value) {
                $list .= '<div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-gray-500">
                            ' . $key . '
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            ' . rupiah($value) . '
                        </dd>
                    </div>';
                $total += $value;
            }

            $result = '<div>
                <div>
                    <span class="leading-6 font-medium text-gray-900">
                        Rincian Tagihan
                    </span>
                </div>
                <div class="mt-5 border-t border-gray-200">
                    <dl class="sm:divide-y sm:divide-gray-200">
                        ' . $list . '
                        <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt class="text-sm font-semibold text-gray-500">
                                Total Tagihan
                            </dt>
                            <dd class="mt-1 text-sm font-semibold text-gray-900 sm:mt-0 sm:col-span-2">
                                ' . rupiah($total) . '
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>';
        } else {
            $result = 'Oops... Rincian tagihan daftar ulang PSB belum tersedia.';
        }


        return $result;
    }
}
