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
            $response = 'Kosong';
            $user = User::query()
                ->with(['billerAnother', 'latestSpp'])
                ->where('id', UserDetail::where('no_pendaftaran', $item->no_peserta)->first()->user_id)
                ->first();

            if (!$user) {
                $this->info("User {$item->no_peserta} tidak ditemukan");
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
                        'Authorization: Basic aHVtYXNuZmJzc2VyYW5nQGdtYWlsLmNvbTp1MnhkVmg=',
                        'Cookie: XSRF-TOKEN=eyJpdiI6IndvOTNSK2hiRmx5WVBXWlA4V0hsSFE9PSIsInZhbHVlIjoiNTJWY3hsUGQrMEtmaDdBbDI3MjVBa2ZwN3hOalA0SVVGc3VjR3FDTXZXdUNTcS9wTFpaNWJjWHZVUVQzUllwbnl2SCtPS0M2SlBBSzRwTHVsSG9DQmJQU0lzbXJEeFRHcDd1MmtWazl1ME9FWWlIRE8zSTFEQlQ2QXFwbFhUUUwiLCJtYWMiOiI3ZjAzZjliN2UyZWU2NmY2MjUxNWZhNGQxYTU0Mjc0MTJjNDVhYzY1NzQ0MmIxMTlhMzczZTg1NjVjYzcyNTAxIiwidGFnIjoiIn0%3D; session_e_ujian_aws_redis_gcp=eyJpdiI6Ik13cXZjc1Z3MTdSMVNmZDFRQU5pc0E9PSIsInZhbHVlIjoiTE01WUdHeFhCc1dEbUVRTDVpT1dNZ1U0WG0rc0JIenpmZ1lybC83SGVPUkErZ3c4Q1NielR4ZitWK1lnT2RuN3p4UU1mRnUxZ0c3dCs2eUNnVXM3RTEvOWk5TC9COWRueWdRajdENUhqZVJ6clNQaW1jbXFGSWRXaGRvOVMwWDYiLCJtYWMiOiJhNjM1YmJjNjI0MGZjMzc4ZDQyNWZkMTA0YzUwOTg4YTk3NGE0NDc2OGQ3YjliZTI1ZTIyNGZkZjllNmQzNDEwIiwidGFnIjoiIn0%3D'
                    ),
                ));

                $response = curl_exec($curl);
                curl_close($curl);
            }

            $item->hak_akses = $allow;
            $item->save();

            $this->info($response);
        }
    }
}
