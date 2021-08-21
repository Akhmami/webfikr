<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UserActivity implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;
    public $description;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user, $description)
    {
        $this->user = $user;
        $this->description = $description;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        activity()->causedBy($this->user)->log($this->description);
    }
}
