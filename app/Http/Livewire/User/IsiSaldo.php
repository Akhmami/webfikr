<?php

namespace App\Http\Livewire\User;

use LivewireUI\Modal\ModalComponent;
use App\Libraries\VA;
use App\Models\Billing;

class IsiSaldo extends ModalComponent
{
    public $trx_amount;

    protected $rules = [
        'trx_amount' => 'required|min:6|max:14'
    ];

    protected $messages = [
        'trx_amount.required' => 'Nominal harus diisi!',
        'trx_amount.min' => 'Nominal minimal 100.000'
    ];

    public function render()
    {
        return view('livewire.user.isi-saldo');
    }

    public function add()
    {
        $validatedData = $this->validate();

        $no_pendaftaran = auth()->user()->userDetail->no_pendaftaran;
        $cek_billing = Billing::where('virtual_account', $no_pendaftaran)
            ->active()->exists();

        if (!$cek_billing) {
            $balance = auth()->user()->balances()->create([
                'trx_id' => 'TOPUP' . date('YmdHis'),
                'virtual_account' => $no_pendaftaran,
                'datetime_expired' => date('Y-m-d H:i:s', strtotime('2 days'))
            ]);

            $data = $balance->toArray();
            $data['customer_name'] = auth()->user()->name;
            $data['trx_amount'] = $this->trx_amount;
            $data['billing_type'] = 'c';
            $data['description'] = 'Isi saldo';

            $client_id = config('bsi.client_id');
            $secret_key = config('bsi.secret_key');
            $va = new VA($client_id, $secret_key);
            $result = $va->create($data);

            return redirect()->to(route('user.pembayaran'));
        } else {
            $this->emit('openModal', 'user.alert-modal', ['message' => 'Masih ada pembayaran yang belum diselesaikan, selengkapnya klik <a href="'.route('user.pembayaran').'" class="underline text-indigo-600">disini</a>']);
        }

    }
}
