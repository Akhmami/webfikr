<?php

namespace App\Http\Livewire\User;

use LivewireUI\Modal\ModalComponent;
use App\Jobs\UserActivity;
use App\Libraries\VA;
use App\Models\User;
use App\Models\Biller;
use App\Models\Billing;

class RincianTagihan extends ModalComponent
{
    public $user;

    public function mount($user)
    {
        $this->user = User::with('activeBillers')->findOrFail($user);
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

        if (!$cek_billing) {
            if ($biller->is_installment === 'Y') {
                $this->emit('openModal', 'user.cicilan', ['biller' => $biller]);
            } else {
                $jenjang = $biller->user->userDetail->jenjang;
                $trx_id = $biller->type . $jenjang . date('YmdHis');

                $data = array(
                    'trx_id' => $trx_id,
                    'user_id' => $biller->user->id,
                    'virtual_account' => $no_pendaftaran,
                    'trx_amount' => $biller->amount,
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
                    $data['datetime_expired'] = date('Y-m-d H:i:s', strtotime('2 days'));
                    $biller->billings()->create($data);
                    return redirect()->to(route('user.pembayaran'));
                }
            }

            UserActivity::dispatch(auth()->user(), 'Memproses tagihan, tombol Bayar Sekarang diklik');
        } else {
            $this->emit('openModal', 'user.alert-modal', ['message' => 'Masih ada pembayaran yang belum diselesaikan, selengkapnya klik <a href="' . route('user.pembayaran') . '" class="underline text-indigo-600">disini</a>']);
        }
    }
}
