<?php

namespace App\Http\Livewire\Psb;

use Livewire\Component;
use App\Jobs\VerifyInternalJob;
use App\Models\Voucher;
use App\Models\SetPsb;
use App\Models\User;

class InternalForm extends Component
{
    public $nik;
    public $pilihan;
    public $tempat_lahir;
    public $tanggal_lahir;
    public $voucher;
    public $diskon;

    public function render()
    {
        $conf = SetPsb::find(1);
        $expired = false;
        $today = strtotime('today');
        $expiry = strtotime($conf->datetime_expired);
        if ($today >= $expiry) {
            $expired = true;
        }

        return view('livewire.psb.internal-form', ['expired' => $expired]);
    }

    public function updated($field)
    {
        if ($field == 'voucher') {
            if (!empty($this->voucher)) {
                $voucher = Voucher::where('name', $this->voucher)->first();

                if ($voucher) {
                    $today = strtotime('today');
                    $expired = strtotime($voucher->datetime_expired);
                    if ($today >= $expired) {
                        $this->voucher = '';
                        session()->flash('vouchererr', 'Mohon maaf, masa berlaku voucher sudah habis klik daftar sekarang untuk melanjutkan!');
                    } else {
                        if (!$voucher->remaining) {
                            $this->voucher = '';
                            session()->flash('vouchererr', 'Mohon maaf, kuota voucher sudah habis klik daftar sekarang untuk melanjutkan!');
                        } else {
                            $this->diskon = $voucher;
                            session()->flash('vouchersuc', 'Alhamdulillah dapat diskon ' . number_format($voucher->value) . ' klik daftar sekarang untuk melanjutkan!');
                        }
                    }
                } else {
                    session()->flash('vouchererr', 'voucher tidak tersedia, klik daftar sekarang untuk melanjutkan!');
                }
            }
        }
    }

    public function store()
    {
        $this->validate([
            'pilihan' => 'required'
        ]);

        switch ($this->pilihan) {
            case 'nik':
                $student = User::where('nik', $this->nik)
                    ->where('jenjang', 'SMP')->latest()->first();
                break;

            default:
                $student = User::where('tempat_lahir', $this->tempat_lahir)
                    ->where('tanggal_lahir', $this->tanggal_lahir)
                    ->where('jenjang', 'SMP')->latest()->first();
                break;
        }

        if (!empty($student)) {
            $student['diskon'] = $this->diskon;
            VerifyInternalJob::dispatch($student);
            $this->emit('showFlash', 'success', 'Pendaftaran berhasil, silahkan cek email anda ' . $student->user->email);
            $this->reset();
        } else {
            $this->emit('showFlash', 'error', 'Mohon maaf, data yang diinput tidak tersedia');
        }
    }
}
