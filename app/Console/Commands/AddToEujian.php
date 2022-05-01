<?php

namespace App\Console\Commands;

use App\Models\Eujian;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Console\Command;

class AddToEujian extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:eujian';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'add user to eujian';

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
        $eujians = Eujian::query()
            ->where('hak_akses', 0)
            ->get();

        foreach ($eujians as $item) {
            $allow = 1;
            $response = '';
            $user = User::query()
                ->with(['billerAnother', 'latestSpp'])
                ->where('username', $item->no_peserta)
                ->first();

            if (!$user) {
                // $this->info("User {$item->no_peserta} tidak ditemukan");
                $user = User::query()
                    ->with(['billerAnother', 'latestSpp'])
                    ->where('id', UserDetail::where('no_pendaftaran', $item->no_peserta)->first()->user_id)
                    ->first();
                continue;
            }

            if (strtotime($user->latestSpp->bulan) < strtotime('2022-05-01')) {
                $allow = 0;
            }

            $tagihanLain = $user->billerAnother->sum('amount') - ($user->billerAnother->sum('cumulative_payment_amount') +
                $user->billerAnother->sum('cost_reduction') +
                $user->billerAnother->sum('balance_used'));

            if ($tagihanLain > 0) {
                $allow = 0;
            }

            if ($allow == 1) {
                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://www.e-ujian.com/api/peserta/add',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => array(
                        'no_peserta' => $item->no_peserta,
                        'nama_peserta' => $item->nama_peserta,
                        'email' => '',
                        'kode_akses' => $item->kode_akses,
                        'kelompok' => $item->kelompok,
                        'tags' => 'US2022'
                    ),
                    CURLOPT_HTTPHEADER => array(
                        'Authorization: Basic aHVtYXNuZmJzc2VyYW5nQGdtYWlsLmNvbTp1MnhkVmg='
                    ),
                ));

                $response = curl_exec($curl);
                curl_close($curl);
            }

            $item->update([
                'hak_akses' => $allow
            ]);

            $this->info($response);
        }
    }
}
