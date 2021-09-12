<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Intervention\Image\Facades\Image;

class ProcessImageThumbnails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $image_path;
    public $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($image_path, $data)
    {
        $this->image_path = $image_path;
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $destination = $this->data['destination'];

        $width = $this->data['width'];
        $height = $this->data['height'];
        $thumbnail = str_replace(".{$this->data['extension']}", "_thumb.{$this->data['extension']}", $this->data['file_name']);
        Image::make(public_path($this->image_path))
            ->resize($width, $height)
            ->save(storage_path('app/' . $destination . '/' . $thumbnail));
    }
}
