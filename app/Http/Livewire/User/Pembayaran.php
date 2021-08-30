<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Jobs\UserActivity;
use App\Libraries\VA;
use Illuminate\Support\Facades\DB;

class Pembayaran extends Component
{
    public $payment;

    public function mount()
    {
        $this->payment = auth()->user()->billings()->active()->latest()->first();
        UserActivity::dispatch(auth()->user(), 'ke halaman pembayaran, menunggu pembayaran');
    }

    public function render()
    {
        return view('livewire.user.pembayaran');
    }

    public function batal()
    {
        DB::beginTransaction();
        try {
            $this->payment->update([
                'datetime_expired' => now()
            ]);

            $data = array(
                'trx_id' => $this->payment->trx_id,
                'trx_amount' => $this->payment->trx_amount,
                'customer_name' => auth()->user()->name,
                'datetime_expired' => date('c', strtotime('now'))
            );

            $va = new VA;
            $result = $va->update($data);
            if ($result['status'] !== '000') {
                $this->emit('openModal', 'user.alert-modal', ['message' => 'Gagal membatalkan tagihan, silahkan coba lagi jika masih berlanjut hubungi kami. #' . $result['status']]);
                DB::rollback();
            }

            DB::commit();
            return redirect()->to(route('user.pembayaran'));
        } catch (\Throwable $th) {
            DB::rollback();
            $this->emit('openModal', 'user.alert-modal', ['message' => 'Gagal membatalkan tagihan, silahkan coba lagi jika masih berlanjut hubungi kami. #' . $th->getMessage()]);
        }
    }
}
