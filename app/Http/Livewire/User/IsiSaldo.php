<?php

namespace App\Http\Livewire\User;

use LivewireUI\Modal\ModalComponent;
use App\Jobs\UserActivity;
use App\Libraries\VA;
use App\Models\Billing;

class IsiSaldo extends ModalComponent
{
    public $trx_amount;

    protected $rules = [
        'trx_amount' => 'required|min:5'
    ];

    protected $messages = [
        'trx_amount.required' => 'Nominal harus dipilih!',
        'trx_amount.min' => 'Nominal tidak disarankan'
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
            $data = array(
                'trx_id' => 'TOPUP' . date('YmdHis'),
                'virtual_account' => $no_pendaftaran,
                'trx_amount' => $this->trx_amount,
                'billing_type' => 'c',
                'customer_name' => auth()->user()->name,
                'description' => 'Isi Saldo',
                'datetime_expired' => date('c', strtotime('5 days'))
            );

            $va = new VA;
            $result = $va->create($data);

            if ($result['status'] !== '000') {
                $this->emit('openModal', 'user.alert-modal', ['message' => 'Gagal memproses permintaan, silahkan coba lagi jika masih berlanjut hubungi kami. #' . $result['status']]);
            } else {
                $data['datetime_expired'] = date('Y-m-d H:i:s', strtotime('5 days'));
                $data['is_balance'] = 'Y';
                auth()->user()->billings()->create($data);

                UserActivity::dispatch(auth()->user(), 'Ngisi saldo');

                return redirect()->to(route('user.pembayaran'));
            }
        } else {
            $this->emit('openModal', 'user.alert-modal', ['message' => 'Masih ada pembayaran yang belum diselesaikan, selengkapnya klik <a href="' . route('user.pembayaran') . '" class="underline text-indigo-600">disini</a>']);
        }
    }
}
