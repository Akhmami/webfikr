<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Facility extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'image'];

    public function subfacilities()
    {
        return $this->hasMany(SubFacility::class);
    }

    public function getImageUrlAttribute($value)
    {
        $imageUrl = null;

        if (!is_null($this->image)) {
            $directory = config('cms.image.facility_directory');
            $imagePath = Storage::exists("{$directory}/" . $this->image);

            if ($imagePath) {
                $imageUrl = Storage::url("{$directory}/" . $this->image);
            }
        }

        return $imageUrl;
    }

    public function getImageThumbUrlAttribute($value)
    {
        $imageUrl = null;

        if (!is_null($this->image)) {
            $directory = config('cms.image.facility_directory');
            $ext = substr(strrchr($this->image, '.'), 1);
            $thumbnail = str_replace(".{$ext}", "_thumb.{$ext}", $this->image);
            $imagePath = Storage::exists("{$directory}/" . $thumbnail);

            if ($imagePath) {
                $imageUrl = Storage::url("{$directory}/" . $thumbnail);
            }
        }

        return $imageUrl;
    }

    public function scopePriority($query)
    {
        return $query->orderBy('priority', 'desc')->latest();
    }
}
