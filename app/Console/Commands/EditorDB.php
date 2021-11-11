<?php

namespace App\Console\Commands;

use App\Libraries\SheetDB;
use App\Models\QuestionnaireAnswer;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Console\Command;

class EditorDB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:editdb';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Edit data dari database';

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
        // foreach ($this->generator() as $item) {
        //     $user = UserDetail::where('no_pendaftaran', $item->no_pendaftaran)->first();
        //     $user->jenis_pendaftaran = 'internal';
        //     $user->save();
        //     $this->info('OK');
        // }

        $answers = QuestionnaireAnswer::get()->groupBy('user_id');
        foreach ($answers as $answer) {
            User::find($answer->user_id)->update(['questionnaire_psb' => 1]);
            $this->info('OK');
        }
    }

    private function generator()
    {
        $sheets = SheetDB::get('https://sheetdb.io/api/v1/7keosobjqp252');

        foreach ($sheets as $sheet) {
            yield $sheet;
        }
    }
}
