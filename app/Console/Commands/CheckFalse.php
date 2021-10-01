<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class CheckFalse extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:checkfalse';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $users = User::has('activeGrade')->with('billerSPP')->cursor();

        foreach ($users as $user) {
            $spp = $user->billerSPP;
            if (!empty($spp)) {
                $qty = $spp->qty_spp;
                $count = $spp->billerDetails->count();

                if ($qty != $count) {
                    $this->error($user->name);
                }
            }
        }
    }
}
