<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Popup extends Model
{
    use HasFactory;

    protected $fillable = ['popup', 'type', 'frequency', 'url'];

    public function getPopupUrlAttribute($value)
    {
        if ($this->type == 'image') {
            $imageUrl = null;

            if (!is_null($this->popup)) {
                $directory = config('cms.image.popup_directory');
                $imagePath = Storage::exists("{$directory}/" . $this->popup);

                if ($imagePath) {
                    $imageUrl = Storage::url("{$directory}/" . $this->popup);
                }
            }

            return $imageUrl;
        } else {
            $imageUrl = $this->popup;
            return $imageUrl;
        }
    }

    public function getPopupThumbUrlAttribute($value)
    {
        if ($this->type == 'image') {
            $imageUrl = null;

            if (!is_null($this->popup)) {
                $directory = config('cms.image.popup_directory');
                $ext = substr(strrchr($this->popup, '.'), 1);
                $thumbnail = str_replace(".{$ext}", "_thumb.{$ext}", $this->popup);
                $imagePath = Storage::exists("{$directory}/" . $thumbnail);

                if ($imagePath) {
                    $imageUrl = Storage::url("{$directory}/" . $thumbnail);
                }
            }

            return '<img src="' . $imageUrl . '" class="img-fluid">';
        } else {
            $imageUrl = $this->popup;
            return $imageUrl;
        }
    }
}
