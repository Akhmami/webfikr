<?php

namespace App\Console\Commands;

use App\Models\FailedSppBiller;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class AutoPayment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:autopay';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pembayaran otomatis memotong saldo';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::with('balance', 'latestSpp', 'billerSPP')
            ->whereHas('balance', function ($query) {
                $query->where('current_amount', '>', 0);
            })
            ->where('status', 'santri')
            ->cursor();

        // dd($users->count());

        foreach ($users as $user) {
            if (!empty($user->billerSPP)) {
                # Get Biller SPP
                $amount = $user->billerSPP->amount;
                $unpaid = $user->billerSPP->billerDetails()->whereNull('is_paid')->first();
                $balance = $user->balance->current_amount;
                # dibayar
                $paymented = array_sum([
                    $unpaid->nominal_setelah_keringanan,
                    $user->billerSPP->cumulative_payment_amount,
                    $user->billerSPP->balance_used,
                    $user->billerSPP->cost_reduction
                ]);

                if ($balance >= $unpaid->nominal_setelah_keringanan) {
                    DB::beginTransaction();
                    try {
                        # Update Biller
                        $is_active = $paymented < $amount ? 'Y' : 'N';
                        $user->billerSPP->increment('balance_used', $unpaid->nominal_setelah_keringanan, [
                            'is_active' => $is_active
                        ]);

                        # update saldo
                        $currentAmount_from_last = $balance;
                        $user->balance()->decrement(
                            'current_amount',
                            $unpaid->nominal_setelah_keringanan,
                            [
                                'last_amount' => $currentAmount_from_last,
                                'type' => 'minus',
                                'nominal' => $unpaid->nominal_setelah_keringanan,
                                'description' => 'Saldo terpakai ' . $user->billerSPP->type
                            ]
                        );

                        # buat riwayat pembayaran oleh saldo
                        $payment = $user->balance->paymentHistories()->create([
                            'user_id' => $user->id,
                            'payment_ntb' => time(),
                            'customer_name' => $user->name,
                            'virtual_account' => $user->userDetail->no_pendaftaran,
                            'payment_amount' => preg_replace('/\D/', '', $unpaid->nominal_setelah_keringanan),
                            'datetime_payment' => date('Y-m-d H:i:s')
                        ]);

                        // SPP PAID
                        $user->spps()->create([
                            'grade_id' => $user->activeGrade()->first()->id,
                            'payment_history_id' => $payment->id,
                            'bulan' => date('Y-m-d', strtotime('+1 month', strtotime($user->latestSpp->bulan)))
                        ]);

                        $user->billerSPP->billerDetails()->whereNull('is_paid')->first()->update([
                            'is_paid' => 'Y'
                        ]);

                        DB::commit();
                    } catch (\Throwable $th) {
                        DB::rollBack();
                        activity('autopay')
                            ->causedBy($user)
                            ->log($user->name . ' Autopay saldo gagal => ' . $th->getMessage());
                    }
                }
            }
        }
    }
}
