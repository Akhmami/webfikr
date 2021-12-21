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
            '{rincian_tagihan_dupsb}' => (!empty($billerDupsb->billerDetails) ? $this->billerDetailHtml($billerDupsb->billerDetails->pluck('nominal', 'nama')) : 'rincian tagihan tidak tersedia'),
            '{progres_dupsb}' => $this->progresDupsbHtml($user),
            '{tahun_pendaftaran}' => $user->tahun_pendaftaran ?? null,
            '{deskripsi_lokasi_tes}' => $lokasi_tes->deskripsi ?? null,
            '{deskripsi_tes_kesehatan}' => $tes_kesehatan->description ?? null,
            '{tgl_tes}' => $gel->tgl_tes ?? null,
            '{tgl_pengumuman}' => $gel->tgl_pengumuman ?? null,
            '{tgl_wawancara}' => $gel->tgl_wawancara ?? null,
            '{batas_pembayaran_dupsb}' => $gel->batas_pembayaran ?? null,
            '{if_smp}' => '<span class="' . $smp . '">',
            '{end_smp}' => '</span>',
            '{if_sma}' => '<span class="' . $sma . '">',
            '{end_sma}' => '</span>',
            '{if_internal}' => '<span class="' . $internal . '">',
            '{end_internal}' => '</span>',
            '{if_eksternal}' => '<span class="' . $eksternal . '">',
            '{end_eksternal}' => '</span>'
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
                $list .= '<div class="py-2 sm:py-3 sm:grid sm:grid-cols-3 sm:gap-4">
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
                        <div class="py-2 sm:py-3 sm:grid sm:grid-cols-3 sm:gap-4">
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

    public function progresDupsbHtml($user)
    {
        if (!empty($user->billerDupsb)) {
            $result = '<fieldset class="space-y-5">
                <legend class="sr-only">Progress</legend>
                <div class="relative flex items-start">
                    <div class="flex items-center h-5">
                        <input type="checkbox" disabled ' . ($user->billerDupsb->amount > $user->billerDupsb->cumulative_payment_amount ? '' : 'checked') . '
                            class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                    </div>
                    <div class="ml-3 text-sm flex flex-col sm:flex-row items-start sm:items-center sm:space-x-4">
                        <div>
                            <label class="font-medium text-gray-700">Pembayaran Daftar Ulang</label>
                            <p class="text-gray-500" style="margin-top: 0.25em; margin-bottom: 0;">
                                Sudah dibayar: ' . rupiah($user->billerDupsb->cumulative_payment_amount) . '
                            </p>
                        </div>
                        ' .
                ($user->billerDupsb->amount > $user->billerDupsb->cumulative_payment_amount ? '<a href="' . route('user.pembayaran') . '" style="color: white; text-decoration: none;"
                            class="inline-flex items-center px-3 py-1 border border-transparent shadow-sm text-sm font-medium text-white bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 rounded-full">
                            Bayar sekarang
                        </a>' : '')
                . '
                    </div>
                </div>
                <div class="relative flex items-start">
                    <div class="flex items-center h-5">
                        <input type="checkbox" disabled ' . ($user->userDetail->jenis_pendaftaran === 'internal' ? 'checked' : '') . '
                            class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                    </div>
                    <div class="ml-3 text-sm flex flex-col sm:flex-row items-start sm:items-center sm:space-x-4">
                        <div>
                            <label for="candidates" class="font-medium text-gray-700">Upload Berkas</label>
                            <p class="text-gray-500" style="margin-top: 0.25em; margin-bottom: 0;">
                                Terupload: ' . ($user->userDetail->jenis_pendaftaran === 'internal' ? 'Tersedia disekolah' : '') . '
                            </p>
                        </div>
                        ' .
                ($user->userDetail->jenis_pendaftaran === 'internal' ? '' : '<a href="' . route('user.berkas') . '" style="color: white; text-decoration: none;"
                            class="inline-flex items-center px-3 py-1 border border-transparent shadow-sm text-sm font-medium text-white bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 rounded-full">
                            Upload sekarang
                        </a>')
                . '
                    </div>
                </div>
                <div class="relative flex items-start">
                    <div class="flex items-center h-5">
                        <input type="checkbox" disabled ' . ($user->userDetail->jenis_pendaftaran === 'internal' ? 'checked' : '') . '
                            class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                    </div>
                    <div class="ml-3 text-sm flex flex-col sm:flex-row items-start sm:items-center sm:space-x-4">
                        <div>
                            <label class="font-medium text-gray-700">Mengisi Ukuran Baju</label>
                            <p class="text-gray-500" style="margin-top: 0.25em; margin-bottom: 0;">
                                Keterangan: ' . ($user->userDetail->jenis_pendaftaran === 'internal' ? 'pengukuran langsung disekolah' : '') . '
                            </p>
                        </div>
                        ' .
                ($user->userDetail->jenis_pendaftaran === 'internal' ? '' : '<a href="' . route('user.pembayaran') . '" style="color: white; text-decoration: none;"
                            class="inline-flex items-center px-3 py-1 border border-transparent shadow-sm text-sm font-medium text-white bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 rounded-full">
                            Isi sekarang
                        </a>')
                . '
                    </div>
                </div>
            </fieldset>';
        } else {
            $result = 'Tagihan Daftar Ulang PSB Tidak Tersedia';
        }

        return $result;
    }
}
