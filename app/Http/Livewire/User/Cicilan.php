<?php

namespace App\Http\Livewire\User;

use App\Jobs\PaymentJob;
use LivewireUI\Modal\ModalComponent;
use App\Libraries\VA;
use App\Models\Biller;
use Illuminate\Support\Facades\DB;

class Cicilan extends ModalComponent
{
    public $max_amount;
    public $biller;
    public $option_id;
    public $options;
    public $user;
    public $cost_reduction;
    public $balance;
    public $total_pay;
    public $saldo_terpakai;

    public function mount(Biller $biller)
    {
        $this->user = auth()->user();
        $this->biller = $biller;

        $qty = $this->biller->qty_spp;
        $keringanan = $this->biller->billerDetails()->sum('keringanan');
        if ($this->biller->type === 'SPP') {
            $divider = $this->user->setSpp->current;
            $i = 1;
            $val = 0;
            $bd = $this->biller->billerDetails()->whereNull('is_paid')->get();
            foreach ($bd as $item) {
                $val = $val + $item->nominal_setelah_keringanan;
                $this->options[$i] = [
                    'value' => $val,
                    'description' => $i . ' Bulan '
                ];
                $i++;
            }
        } else {
            $divider = ($biller->amount - $biller->hitung_keringanan) / $qty;
            for ($i = 1; $i <= $qty; $i++) {
                $val = ($i * $divider);
                $this->options[$i] = [
                    'value' => $val,
                    'description' => $i . ' Bulan '
                ];
            }
        }

        $this->max_amount = $biller->amount - ($biller->cumulative_payment_amount + $keringanan + $biller->balance_used);
    }

    public function render()
    {
        $selected = (($this->options[$this->option_id]['value']) ?? 0);
        $calculate = $selected - $this->balance;

        // klo saldonya kurang
        if ($calculate > 0) {
            $this->total_pay = $calculate;
            $this->saldo_terpakai = $this->balance;
        } else {
            $this->total_pay = 0;
            $this->saldo_terpakai = abs($selected);
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

        // kalo saldonya kurang, bayar sisa tagihan
        if ($this->total_pay > 0) {
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
                'datetime_expired' => date('c', strtotime('5 days'))
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

                $data['use_balance'] = $this->saldo_terpakai;
                $data['datetime_expired'] = date('Y-m-d H:i:s', strtotime('5 days'));
                $this->user->billings()->create($data);
                return redirect()->to(route('user.pembayaran'));
            }
        } else {
            DB::beginTransaction();
            try {
                # Update Biller
                $biller_cpa = $this->biller->balance_used ?? 0;
                $cpa_now = $biller_cpa + $this->saldo_terpakai;
                $paymented = $cpa_now + $this->biller->cost_reduction;
                $is_active = ($paymented < $this->biller->amount) ? 'Y' : 'N';

                auth()->user()->billers()->where('id', $this->biller->id)->update([
                    'balance_used' => $cpa_now,
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
                    for ($i = 1; $i <= $this->option_id; $i++) {
                        // SPP PAID
                        $adder = '+' . $i . ' month';
                        $this->user->spps()->create([
                            'grade_id' => $this->user->activeGrade()->first()->id,
                            'payment_history_id' => $payment->id,
                            'bulan' => date('Y-m-d', strtotime($adder, strtotime($this->user->latestSpp->bulan)))
                        ]);
                    }
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
}
