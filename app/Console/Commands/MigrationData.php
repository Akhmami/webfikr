<?php

namespace App\Console\Commands;

use App\Actions\Migrate\MoveToParentTable;
use Illuminate\Console\Command;

class MigrationData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:migratedata';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrasi data dari table lama';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(MoveToParentTable $moveToParentTable)
    {
        // Move data to Parent from UserDetail
        $moveToParentTable->migrate();
        // Move data to Payment from Billing and PaymentHistory
        $this->moveToPayment();
    }
}
