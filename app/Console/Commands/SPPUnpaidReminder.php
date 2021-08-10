<?php

namespace App\Console\Commands;

use App\Models\Biller;
use Illuminate\Console\Command;
use App\Libraries\WA;

class SPPUnpaidReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sppreminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notifikasi pengingat pembayaran SPP';

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
        $billers = Biller::where('type', 'SPP')
            ->where('is_active', 'Y')->cursor();

        foreach ($billers as $biller) {
            $wa = new WA($biller->user);
            $wa->notifyPayment('');
        }
    }
}
