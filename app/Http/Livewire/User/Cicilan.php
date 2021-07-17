<?php

namespace App\Http\Livewire\User;

use LivewireUI\Modal\ModalComponent;

class Cicilan extends ModalComponent
{
    public $max_amount;
    public $payment_amount;

    public function mount($biller)
    {
        $this->max_amount = rupiah($biller['amount']);
    }

    public function render()
    {
        return view('livewire.user.cicilan');
    }

    public function bayar()
    {
        $jenjang = $biller->user->userDetail->jenjang;
        $trx_id = $biller->type . $jenjang . 'T' . date('YmdHis');
        $billing = $biller->billings()->create([
            'trx_id' => $trx_id,
            'user_id' => $biller->user->id,
            'virtual_account' => $no_pendaftaran,
            'trx_amount' => $biller->amount,
            'billing_type' => 'c',
            'description' => 'Pembayaran ' . $biller->type,
            'datetime_expired' => date('Y-m-d H:i:s', strtotime('2 days'))
        ]);

        $this->emit('openModal', 'alert-modal', [
            'emit' => 'closeTagihanAlertModal',
            'title' => 'Pembayaran Cicilan',
            'description' => 'Pembayaran cicilan berhasil dibuat, untuk informasi pembayaran klik disini'
        ]);
    }
}
