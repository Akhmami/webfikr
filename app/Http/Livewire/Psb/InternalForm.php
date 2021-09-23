<?php

namespace App\Http\Livewire\Psb;

use Livewire\Component;
use App\Jobs\VerifyInternalJob;
use App\Models\Internal;
use App\Models\Voucher;
use App\Models\User;

class InternalForm extends Component
{
    public $nik;
    public $pilihan;
    public $birth_place;
    public $birth_date;
    public $voucher;
    public $diskon;
    public $list_pilihan;
    public $inputVoucher;

    public function mount()
    {
        $this->list_pilihan = ['nik' => 'Nomor Induk Kependudukan', 'ttl' => 'Tanggal Lahir'];
    }

    public function render()
    {
        return view('livewire.psb.internal-form');
    }

    public function updated($field)
    {
        if ($field === 'voucher') {
            if (!empty($this->voucher)) {
                $voucher = Voucher::where('name', $this->voucher)->first();

                if ($voucher) {
                    $today = strtotime('today');
                    $expired = strtotime($voucher->datetime_expired);
                    if ($today >= $expired) {
                        $this->voucher = '';
                        session()->flash('vouchererr', 'Mohon maaf, masa berlaku voucher sudah habis klik daftar sekarang untuk melanjutkan!');
                    } else {
                        if ($voucher->available < 1) {
                            $this->voucher = '';
                            session()->flash('vouchererr', 'Mohon maaf, kuota voucher sudah habis klik daftar sekarang untuk melanjutkan!');
                        } else {
                            $this->diskon = $voucher;
                            session()->flash('vouchersuc', 'Alhamdulillah dapat diskon ' . $voucher->nominal . ' klik daftar sekarang untuk melanjutkan!');
                        }
                    }
                } else {
                    session()->flash('vouchererr', 'voucher tidak tersedia, klik daftar sekarang untuk melanjutkan!');
                }
            }
        }
    }

    public function hydrate()
    {
        $this->resetValidation();
    }

    public function showVoucher()
    {
        $this->inputVoucher = true;
    }

    public function store()
    {
        $this->validate([
            'pilihan' => 'required'
        ]);

        switch ($this->pilihan) {
            case 'nik':
                $user = User::whereHas('userDetail', function ($query) {
                    $query->where('nik', $this->nik)
                        ->where('jenjang', 'SMP')->latest('id');
                })->first();
                break;

            default:
                $user = User::where('birth_place', $this->birth_place)
                    ->where('birth_date', $this->birth_date)
                    ->where('jenjang', 'SMP')->latest('id')->first();
                break;
        }

        if (!empty($user)) {
            $user['diskon'] = $this->diskon;
            VerifyInternalJob::dispatch($user);
            $this->emit('showFlash', 'success', 'Pendaftaran berhasil, silahkan cek email anda ' . $user->email);
            $this->reset();
        } else {
            $this->emit('showFlash', 'error', 'Mohon maaf, data yang diinput tidak tersedia');
        }
    }
}
