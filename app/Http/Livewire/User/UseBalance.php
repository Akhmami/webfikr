<?php

namespace App\Http\Livewire\User;

use App\Libraries\VA;
use App\Models\Biller;
use LivewireUI\Modal\ModalComponent;

class UseBalance extends ModalComponent
{
    public $max_amount;
    public $biller;
    public $user;
    public $keringanan;
    public $balance;
    public $total_pay;

    public function mount(Biller $biller)
    {
        $this->user = auth()->user();
        $this->biller = $biller;

        if ($this->biller->type === 'SPP') {
            $this->keringanan = $this->user->costReductions()
                ->unused()->where('type', 'SPP')->first()->nominal ?? 0;
        } else {
            $this->keringanan = $this->user->costReductions()
                ->unused()->where('type', '<>', 'SPP')->first()->nominal ?? 0;
        }

        $this->max_amount = $biller->amount - $biller->cumulative_payment_amount - $this->keringanan;
    }

    public function render()
    {
        $calculate = $this->max_amount - $this->balance;

        if ($calculate < 0) {
            $this->total_pay = 0;
        } else {
            $this->total_pay = $calculate;
        }

        return view('livewire.user.use-balance', [
            'total_balance' => (auth()->user()->balance->current_amount ?? 0)
        ]);
    }

    public function bayar()
    {
        $biller = $this->biller;
        $no_pendaftaran = $biller->user->userDetail->no_pendaftaran;
        $jenjang = $biller->user->userDetail->jenjang;
        $trx_id = $biller->type . $jenjang . date('YmdHis');

        $data = array(
            'trx_id' => $trx_id,
            'user_id' => $biller->user->id,
            'virtual_account' => $no_pendaftaran,
            'trx_amount' => $this->total_pay,
            'billing_type' => 'c',
            'customer_name' => auth()->user()->name,
            'description' => 'Pembayaran ' . $biller->type,
            'datetime_expired' => date('c', strtotime('2 days'))
        );

        $va = new VA;
        $result = $va->create($data);

        if ($result['status'] !== '000') {
            $this->emit('openModal', 'user.alert-modal', ['message' => 'Gagal memproses tagihan, silahkan coba lagi jika masih berlanjut hubungi kami. #' . $result['status']]);
        } else {
            if ($this->biller->type === 'SPP') {
                $month = date('Y-m-d', strtotime('+1 month', strtotime($this->user->latestSpp->bulan)));
                $data['spp_pay_month'] = json_encode([$month]);
            }

            $data['use_balance'] = $this->balance ?? 0;
            $data['datetime_expired'] = date('Y-m-d H:i:s', strtotime('2 days'));
            $biller->billings()->create($data);
            return redirect()->to(route('user.pembayaran'));
        }
    }
}
