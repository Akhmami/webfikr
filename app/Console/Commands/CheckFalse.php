<?php

namespace App\Console\Commands;

use App\Libraries\SheetDB;
use App\Models\User;
use App\Models\UserDetail;
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
        $users = User::has('activeGrade')
            ->with('setSpp', 'latestSpp', 'billerSPP')
            ->cursor();

        foreach ($users as $user) {
            $user->status = 'santri';
            $user->save();
        }
    }

    private function generator()
    {
        $sheets = SheetDB::get('https://sheetdb.io/api/v1/n8q4yb5v6rps1');

        foreach ($sheets as $sheet) {
            yield $sheet;
        }
    }
}
