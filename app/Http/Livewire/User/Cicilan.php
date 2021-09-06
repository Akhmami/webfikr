<?php

namespace App\Http\Livewire\User;

use LivewireUI\Modal\ModalComponent;
use App\Libraries\VA;
use App\Models\Biller;

class Cicilan extends ModalComponent
{
    public $max_amount;
    public $biller;
    public $option_id;
    public $options;
    public $user;
    public $cost_reduction;
    public $keringanan;
    public $balance;
    public $total_pay;

    public function mount(Biller $biller)
    {
        $this->user = auth()->user();
        $this->biller = $biller;

        $qty = $this->biller->qty_spp;
        if ($this->biller->type === 'SPP') {
            $divider = $this->user->setSpp->nominal;
            $this->keringanan = $this->user->costReductions()
                ->unused()->where('type', 'SPP')->first()->nominal ?? 0;
        } else {
            $divider = $biller->amount / $qty;
            $this->keringanan = $this->user->costReductions()
                ->unused()->where('type', '<>', 'SPP')->first()->nominal ?? 0;
        }

        $this->max_amount = $biller->amount - $biller->cumulative_payment_amount - $this->keringanan;

        for ($i = 1; $i <= $qty; $i++) {
            $val = ($i * $divider) - $this->keringanan;
            if ($val > $this->max_amount) {
                break;
            }

            $this->options[$i] = [
                'value' => $val,
                'description' => $i . ' Bulan '
            ];
        }
    }

    public function render()
    {
        $selected = (($this->options[$this->option_id]['value']) ?? 0);
        $calculate = $selected - $this->balance;

        if ($calculate < 0) {
            $this->total_pay = 0;
        } else {
            $this->total_pay = $calculate;
        }

        return view('livewire.user.cicilan', [
            'total_balance' => (auth()->user()->balance->current_amount ?? 0)
        ]);
    }

    public function bayar()
    {
        $this->validate([
            'option_id' => 'required'
        ]);

        $jenjang = $this->user->userDetail->jenjang;
        $trx_id = $this->biller->type . $jenjang . date('YmdHis');
        $payment_amount = $this->total_pay;

        $data = array(
            'biller_id' => $this->biller->id,
            'trx_id' => $trx_id,
            'virtual_account' => $this->user->userDetail->no_pendaftaran,
            'trx_amount' => $payment_amount,
            'billing_type' => 'c',
            'customer_name' => $this->user->name,
            'description' => 'Pembayaran ' . $this->biller->type,
            'datetime_expired' => date('c', strtotime('2 days'))
        );

        $va = new VA;
        $result = $va->create($data);

        if ($result['status'] !== '000') {
            $this->emit('openModal', 'user.alert-modal', ['message' => 'Gagal memproses tagihan, silahkan coba lagi jika masih berlanjut hubungi kami. #' . $result['status']]);
        } else {
            if ($this->biller->type === 'SPP') {
                $month = [];
                for ($i = 1; $i <= $this->option_id; $i++) {
                    $adder = '+' . $i . ' month';
                    $month[] = date('Y-m-d', strtotime($adder, strtotime($this->user->latestSpp->bulan)));
                }
                $data['spp_pay_month'] = json_encode($month);
            }

            $data['use_balance'] = $this->balance ?? 0;
            $data['datetime_expired'] = date('Y-m-d H:i:s', strtotime('2 days'));
            $this->user->billings()->create($data);
            return redirect()->to(route('user.pembayaran'));
        }
    }
}
