<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyInternal;

class VerifyInternalJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $diskon;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
        $this->diskon = $this->user->diskon;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = [
            'id' => $this->user->id,
            'no_unik' => substr($this->user->userDetail->no_pendaftaran, -4),
            'nama' => $this->user->name,
            'email' => $this->user->email,
            'diskon' => $this->diskon,
            'datetime_expired' => date('Y-m-d H:i:s', strtotime('+1 day')),
        ];

        Mail::to($this->user->email)->send(new VerifyInternal($data));
    }
}
