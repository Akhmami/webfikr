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

    protected $student;
    protected $diskon;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($student)
    {
        $this->student = $student;
        $this->diskon = $this->student->diskon;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = [
            'id' => $this->student->user->id,
            'no_unik' => substr($this->student->no_pendaftaran, -4),
            'nama' => $this->student->nama_lengkap,
            'email' => $this->student->user->email,
            'diskon' => $this->diskon,
            'datetime_expired' => date('Y-m-d H:i:s', strtotime('+1 day')),
        ];

        Mail::to($this->student->user->email)->send(new VerifyInternal($data));
    }
}
