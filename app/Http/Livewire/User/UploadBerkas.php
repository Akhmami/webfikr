<?php

namespace App\Http\Livewire\User;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\UserFile;
use Intervention\Image\Facades\Image;

class UploadBerkas extends Component
{
    public function render()
    {
        return view('livewire.user.upload-berkas');
    }

    public function store()
    {
        $validatedData = $this->validate();

        if (!is_null($this->file)) {
            $extension = $this->file->getClientOriginalExtension();
            $validatedData['file'] = auth()->user()->username . '-' . time() . '.' . $extension;
            $destination = config('cms.userfile.directory');
            $this->file->storeAs($destination, $validatedData['file']);
        }

        if (!is_null($this->postId)) {
            if (!is_null($this->image)) {
                $oldImage = $this->post->image;
                $post = tap($this->post)->update($validatedData);

                if ($oldImage !== $post->image) {
                    $imagePath = $destination . '/' . $oldImage;
                    $ext = substr(strrchr($oldImage, '.'), 1);
                    $thumbnail = str_replace(".{$ext}", "_thumb.{$ext}", $oldImage);
                    $thumbnailPath = $destination . '/' . $thumbnail;

                    if (Storage::exists($imagePath)) {
                        Storage::delete($imagePath);
                    }
                    if (Storage::exists($thumbnailPath)) {
                        Storage::delete($thumbnailPath);
                    }
                }
            } else {
                $this->post->title = $validatedData['title'];
                $this->post->slug = $validatedData['slug'];
                $this->post->body = $validatedData['body'];
                $this->post->category_id = $validatedData['category_id'];
                $this->post->published_at = $validatedData['published_at'];
                $post = $this->post->save();
            }
        } else {
            $post = auth()->user()->posts()->create($validatedData);
        }

        if (!is_null($this->image)) {
            $thumbnail = str_replace(".{$extension}", "_thumb.{$extension}", $validatedData['image']);
            Image::make($this->image->getRealPath())
                ->save(storage_path('app/' . $destination . '/' . $thumbnail));
        }

        return redirect()->route('dash.website.index');
    }

    protected function rules()
    {
        return [
            'title' => 'required',
            'slug' => 'required|unique:posts,slug,' . $this->postId,
            // 'excerpt' => 'required',
            'body' => 'required',
            'published_at' => 'nullable|date_format:Y-m-d',
            'category_id' => 'required',
            'image' => 'nullable|mimes:jpg,jpeg,bmp,png'
        ];
    }
}
