<?php

namespace App\Http\Livewire\User;

use LivewireUI\Modal\ModalComponent;
use App\Models\User;
use App\Models\Biller;
use App\Models\Billing;

class RincianTagihan extends ModalComponent
{
    public $user;

    public function mount($user)
    {
        $this->user = User::with('activeBillers')->findOrFail($user);
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

        if (!$cek_billing) {
            if ($biller->is_installment === 'Y') {
                $this->emit('openModal', 'user.cicilan', ['biller' => $biller]);
            } else {
                $jenjang = $biller->user->userDetail->jenjang;
                $trx_id = $biller->type . $jenjang . date('YmdHis');
                $billing = $biller->billings()->create([
                    'trx_id' => $trx_id,
                    'user_id' => $biller->user->id,
                    'virtual_account' => $no_pendaftaran,
                    'trx_amount' => $biller->amount,
                    'billing_type' => 'c',
                    'description' => 'Pembayaran ' . $biller->type,
                    'datetime_expired' => date('Y-m-d H:i:s', strtotime('2 days'))
                ]);
            }
        } else {
            $this->emit('openModal', 'user.alert-modal', ['message' => 'Mohon maaf, sepertinya masih ada pembayaran yang belum diselesaikan']);
        }
    }
}
