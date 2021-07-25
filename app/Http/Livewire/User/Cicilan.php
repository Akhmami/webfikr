<?php

namespace App\Http\Livewire\User;

use LivewireUI\Modal\ModalComponent;
use App\Libraries\VA;

class Cicilan extends ModalComponent
{
    public $max_amount;
    public $payment_amount;
    public $biller;
    public $options;

    public function mount($biller)
    {
        $this->biller = $biller;
        $this->max_amount = $biller['amount'] - $biller['cumulative_payment_amount'];
        $qty = $this->biller['qty_spp'];
        if ($this->biller['type'] === 'SPP') {
            $divider = auth()->user()->setSpp->nominal;
        } else {
            $divider = $biller['amount'] / $qty;
        }

        for ($i=1; $i <= $qty; $i++) {
            $val = $i * $divider;
            if ($val > $this->max_amount) {
                break;
            }

            $this->options[] = [
                'value' => $val,
                'description' => $i . ' Bulan'
            ];
        }
    }

    public function render()
    {
        return view('livewire.user.cicilan');
    }

    public function bayar()
    {
        $jenjang = auth()->user()->userDetail->jenjang;
        $trx_id = $this->biller['type'] . $jenjang . date('YmdHis');
        $client_id = config('bsi.client_id');
        $secret_key = config('bsi.secret_key');

        $data = array(
            'biller_id' => $this->biller['id'],
            'trx_id' => $trx_id,
            'virtual_account' => auth()->user()->userDetail->no_pendaftaran,
            'trx_amount' => $this->payment_amount,
            'billing_type' => 'c',
            'customer_name' => auth()->user()->name,
            'description' => 'Pembayaran ' . $this->biller['type'],
            'datetime_expired' => date('c', strtotime('2 days'))
        );

        $va = new VA($client_id, $secret_key);
        $result = $va->create($data);

        if ($result['status'] !== '000') {
            $this->emit('openModal', 'user.alert-modal', ['message' => 'Gagal memproses tagihan, silahkan coba lagi jika masih berlanjut hubungi kami.']);
        } else {
            $data['datetime_expired'] = date('Y-m-d H:i:s', strtotime('2 days'));
            auth()->user()->billings()->create($data);
            return redirect()->to(route('user.pembayaran'));
        }
    }
}
