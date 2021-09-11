<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class Post extends Model
{
    use HasFactory, Sluggable, SoftDeletes;

    protected $dates = ['published_at', 'deleted_at'];
    protected $fillable = ['title', 'slug', 'excerpt', 'body', 'published_at', 'category_id', 'image'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getImageUrlAttribute($value)
    {
        $imageUrl = asset('images/blog/default.jpg');

        if (!is_null($this->image)) {
            $directory = config('cms.image.directory');
            $imagePath = Storage::exists("{$directory}/" . $this->image);

            if ($imagePath) {
                $imageUrl = Storage::url("{$directory}/" . $this->image);
            }
        }

        return $imageUrl;
    }

    public function getImageThumbUrlAttribute($value)
    {
        $imageUrl = asset('images/blog/default_thumb.jpg');

        if (!is_null($this->image)) {
            $directory = config('cms.image.directory');
            $ext = substr(strrchr($this->image, '.'), 1);
            $thumbnail = str_replace(".{$ext}", "_thumb.{$ext}", $this->image);
            $imagePath = Storage::exists("{$directory}/" . $thumbnail);

            if ($imagePath) {
                $imageUrl = Storage::url("{$directory}/" . $thumbnail);
            }
        }

        return $imageUrl;
    }

    public function getDateAttribute($value)
    {
        return is_null($this->published_at) ? '' : $this->published_at->diffForHumans();
    }

    public function dateFormatted($showTime = false)
    {
        $format = "d/m/Y";
        if ($showTime) {
            $format = $format . " H:i:s";
        }
        return $this->created_at->format($format);
    }

    public function publicationLabel()
    {
        if (!$this->published_at) {
            return '<span class="badge badge-warning">Draft</span>';
        } elseif ($this->published_at && $this->published_at->isFuture()) {
            return '<span class="badge badge-info">Schedule</span>';
        } else {
            return '<span class="badge badge-success">Published</span>';
        }
    }

    public function scopeLatestFirst($query)
    {
        return $query->orderBy('published_at', 'desc');
    }

    public function scopePinned($query)
    {
        return $query->orderBy('pinned', 'desc');
    }

    public function scopePopular($query)
    {
        return $query->orderBy('view_count', 'desc');
    }

    public function scopeAchievement($query)
    {
        return $query->where('category_id', 2);
    }

    public function scopeTeacherNote($query)
    {
        return $query->where('category_id', 3);
    }

    public function scopeInfo($query)
    {
        return $query->where('category_id', 5);
    }

    public function scopePublished($query)
    {
        return $query->where("published_at", "<=", Carbon::now());
    }

    public function scopeScheduled($query)
    {
        return $query->where("published_at", ">", Carbon::now());
    }

    public function scopeDraft($query)
    {
        return $query->whereNull("published_at");
    }
}
