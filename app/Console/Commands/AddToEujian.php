<?php

namespace App\Console\Commands;

use App\Models\Eujian;
use App\Models\User;
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
            $user = User::query()
                ->with(['billerAnother', 'latestSpp', 'userDetail'])
                ->where('username', $item->no_peserta)
                ->first();

            if (!$user) {
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

            if ($allow === 1) {
                $this->userEujian($item);
            }

            $item->hak_akses = $allow;
            $item->save();
        }
    }

    public function userEujian($item)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://www.e-ujian.com/api/peserta/add',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
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
        return $response;
    }
}
