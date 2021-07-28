<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class InjectNewStudent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:newstudent';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Inject new student from spreadsheet';

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
        foreach ($this->generator() as $item) {
            // USE DB::TRANSACTIONS

            // CREATE USER

            // GIVE ROLES

            // CREATE USER DETAIL

            // CREATE MOBILE PHONES

            // GIVE GRADES

            // SET SPP

            // CREATE BILLER SPP JULY
        }
    }

    private function generator()
    {
        $sheets = SheetDB::get('https://sheetdb.io/api/v1/xe7yv0zkgyw0r');

        foreach ($sheets as $sheet) {
            yield $sheet;
        }
    }
}
