<?php

namespace App\Console\Commands;

use App\Models\Billing;
use App\Models\Post;
use App\Models\SetSpp;
use App\Models\User;
use Illuminate\Console\Command;

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
        $spps = SetSpp::cursor();

        foreach ($spps as $item) {
            $item->update(['current' => $item->nominal]);
        }
    }
}
