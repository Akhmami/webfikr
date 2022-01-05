<?php

namespace App\Http\Livewire\User;

use App\Libraries\VA;
use App\Models\Biller;
use Illuminate\Support\Facades\DB;
use LivewireUI\Modal\ModalComponent;

class UseBalance extends ModalComponent
{
    public $max_amount;
    public $biller;
    public $user;
    public $balance;
    public $total_pay;
    public $saldo_terpakai;

    public function mount(Biller $biller)
    {
        $this->user = auth()->user();
        $this->biller = $biller;
        $this->max_amount = $biller->amount - ($biller->cumulative_payment_amount + $this->biller->hitung_keringanan + $this->biller->balance_used);
    }

    public function render()
    {
        $calculate = $this->max_amount - $this->balance;

        // klo saldonya kurang/kepake semua
        if ($calculate > 0) {
            $this->total_pay = $calculate;
            $this->saldo_terpakai = $this->balance;
        } else {
            $this->total_pay = 0;
            $this->saldo_terpakai = abs($this->max_amount);
        }

        return view('livewire.user.use-balance', [
            'total_balance' => (auth()->user()->balance->current_amount ?? 0)
        ]);
    }

    public function bayar()
    {
        # kalo saldo kurang, bayar sisa tagihan
        if ($this->total_pay > 0) {
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
                'datetime_expired' => date('c', strtotime('5 days'))
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
                $data['datetime_expired'] = date('Y-m-d H:i:s', strtotime('5 days'));
                $biller->billings()->create($data);
                return redirect()->to(route('user.pembayaran'));
            }
        } else {
            DB::beginTransaction();
            try {
                # Update Biller
                $paymented = array_sum([
                    $this->saldo_terpakai,
                    $this->biller->cumulative_payment_amount,
                    $this->biller->balance_used,
                    $this->biller->cost_reduction
                ]);
                $is_active = $paymented < $this->biller->amount ? 'Y' : 'N';
                $this->biller->increment('balance_used', $this->saldo_terpakai, [
                    'is_active' => $is_active
                ]);

                # update saldo
                $currentAmount_from_last = $this->user->balance->current_amount ?? 0;
                $this->user->balance()->decrement(
                    'current_amount',
                    $this->saldo_terpakai,
                    [
                        'last_amount' => $currentAmount_from_last,
                        'type' => 'minus',
                        'nominal' => $this->saldo_terpakai,
                        'description' => 'Saldo terpakai ' . $this->biller->type
                    ]
                );

                # buat riwayat pembayaran oleh saldo
                $payment = $this->user->balance->paymentHistories()->create([
                    'user_id' => $this->user->id,
                    'payment_ntb' => time(),
                    'customer_name' => $this->user->name,
                    'virtual_account' => $this->user->userDetail->no_pendaftaran,
                    'payment_amount' => preg_replace('/\D/', '', $this->saldo_terpakai),
                    'datetime_payment' => date('Y-m-d H:i:s')
                ]);

                if ($this->biller->type === 'SPP') {
                    // SPP PAID
                    $this->user->spps()->create([
                        'grade_id' => $this->user->activeGrade()->first()->id,
                        'payment_history_id' => $payment->id,
                        'bulan' => date('Y-m-d', strtotime('+1 month', strtotime($this->user->latestSpp->bulan)))
                    ]);

                    $this->biller->billerDetails()->whereNull('is_paid')->first()->update([
                        'is_paid' => 'Y'
                    ]);
                }

                $this->emit('openModal', 'alert-modal', [
                    'status' => 'success',
                    'emit' => 'closeBalanceAlertModal',
                    'title' => 'Pembayaran berhasil!',
                    'description' => 'Terimakasih telah melakukan pembayaran, semoga Allah berikan keberkahan rizki.'
                ]);

                DB::commit();
            } catch (\Throwable $th) {
                DB::rollback();
                $this->emit('openModal', 'user.alert-modal', ['message' => 'Gagal memproses tagihan, silahkan coba lagi jika masih berlanjut hubungi kami. #' . $th->getMessage()]);
            }
        }
    }

    public static function closeModalOnEscape(): bool
    {
        return false;
    }

    public static function closeModalOnClickAway(): bool
    {
        return false;
    }
}
