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
        $users = User::whereHas('roles', function ($q) {
            $q->where('name', 'user');
        })->cursor();
        foreach ($users as $user) {
            $user->update(['password' => '$2y$10$A0bttMCw3Z6iq6EQukJ7ZOsuKrGCR4FpMkva/5bqHaYIecMNxiRzy']);
        }
    }
}
