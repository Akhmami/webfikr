<?php

namespace App\Http\Controllers;

use App\Models\UserFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    protected $uploadPath;

    public function __construct()
    {
        $this->uploadPath = config('cms.user.file');
    }

    public function index()
    {
        $uploads = auth()->user()->files;

        return view('user.berkas', compact('uploads'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'file' => 'required|mimes:pdf|max:5128'
        ]);

        $data = $this->handleFile($request);
        $file = auth()->user()->files()
            ->where('nama', $request->nama)->first();

        if ($file) {
            $oldFile = $file->file;
            $file->update($data);
            if ($oldFile !== $file->file) {
                $this->removeFile($oldFile);
            }
        } else {
            UserFile::create($data);
        }

        return back()
            ->with('success', 'Berkas berhasil di upload!');
    }

    public function show($file)
    {
        $pathToFile = public_path('storage/file_from_user/' . $file);
        return response()->file($pathToFile);
    }

    private function handleFile($request)
    {
        $data = $request->all();

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $fileName = str_replace(' ', '_', $request->nama) . '_' . str_replace(' ', '-', auth()->user()->name) . '.' . $extension;
            $destination = $this->uploadPath;

            $file->storeAs($destination, $fileName);

            $data['user_id'] = auth()->id();
            $data['file'] = $fileName;
        }

        return $data;
    }

    private function removeFile($file)
    {
        if (!empty($file)) {
            $filePath = $this->uploadPath . '/' . $file;

            if (Storage::exists($filePath)) {
                Storage::delete($filePath);
            }
        }
    }
}
