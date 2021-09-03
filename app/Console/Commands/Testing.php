<?php

namespace App\Console\Commands;

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
        $users = User::has('billings')->cursor();

        foreach ($users as $user) {
            $name = $user->name;
            $name2 = $user->billings()->first()->customer_name;

            if (strtolower($name) != strtolower($name2)) {
                $this->error($name . ' => ' . $name2);
            }
        }
    }
}
