<?php

namespace App\Http\Livewire\User;

use LivewireUI\Modal\ModalComponent;
use App\Jobs\UserActivity;
use App\Models\Biller;
use App\Models\Billing;

class RincianTagihan extends ModalComponent
{
    public $activeBillers;

    public function mount()
    {
        $user = auth()->user();
        $this->activeBillers = $user->activeBillers;
        UserActivity::dispatch(auth()->user(), 'mengklik tombaol Rincian Tagihan');
    }

    public function render()
    {
        return view('livewire.user.rincian-tagihan');
    }

    public function bayar($biller_id)
    {
        $biller = Biller::with('user')->findOrFail($biller_id);
        $no_pendaftaran = $biller->user->userDetail->no_pendaftaran;
        $cek_billing = Billing::where('virtual_account', $no_pendaftaran)
            ->active()->exists();

        if ($biller->amount > 0) {
            if (!$cek_billing) {
                // kalo pembayaran lebih dari 1 bln/cicilan
                if ($biller->is_installment === 'Y') {
                    $this->emit('openModal', 'user.cicilan', ['biller' => $biller]);
                } else {
                    $this->emit('openModal', 'user.use-balance', ['biller' => $biller]);
                }

                UserActivity::dispatch(auth()->user(), 'Memproses tagihan, tombol Bayar Sekarang diklik');
            } else {
                $this->emit('openModal', 'user.alert-modal', ['message' => 'Masih ada pembayaran yang belum diselesaikan, selengkapnya klik <a href="' . route('user.pembayaran') . '" class="underline text-indigo-600">disini</a>']);
            }
        } else {
            $this->emit('openModal', 'user.alert-modal', ['message' => 'Pembayaran tidak dapat di proses, tagihan kosong']);
        }
    }
}
