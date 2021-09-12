<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class RemoveImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $oldImage;
    public $data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($oldImage, $data)
    {
        $this->oldImage = $oldImage;
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if (!empty($oldImage)) {
            $imagePath = $this->data['destination'] . '/' . $oldImage;
            $ext = substr(strrchr($oldImage, '.'), 1);
            $thumbnail = str_replace(".{$ext}", "_thumb.{$ext}", $oldImage);
            $thumbnailPath = $this->data['destination'] . '/' . $thumbnail;

            if (Storage::exists($imagePath)) {
                Storage::delete($imagePath);
            }
            if (Storage::exists($thumbnailPath)) {
                Storage::delete($thumbnailPath);
            }
        }
    }
}
