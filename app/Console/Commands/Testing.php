<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Libraries\VA;

class Testing extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:testing';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Testing running code';

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
        $client_id = '1234';
        $secret_key = 'adagag40245262vdsfgsgwt';
        $va = new VA($client_id, $secret_key);
        $data = array(
            'trx_id' => 'TRXID11111',
            'trx_amount' => 3500000,
            'billing_type' => 'c',
            'datetime_expired' => date('c', strtotime('2 month')),
            'virtual_account' => '11111',
            'customer_name' => 'Ini Budi',
            'customer_email' => 'akhmami@gmail.com',
            'customer_phone' => '085156154439',
            'description' => 'spp'
        );

        $result = $va->create($data);
        dd($result);
    }
}
