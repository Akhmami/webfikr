<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BajuController extends Controller
{
    public function index()
    {
        $baju = auth()->user()->clothes;

        return view('user.baju', ['baju' => $baju]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama.*' => 'required',
            'ukuran.*' => 'required'
        ]);

        auth()->user()->clothes()->createMany([
            [
                'nama' => $request->nama[0],
                'ukuran' => $request->ukuran[0],
                'deskripsi' => $request->deskripsi[0],
            ],
            [
                'nama' => $request->nama[1],
                'ukuran' => $request->ukuran[1],
                'deskripsi' => $request->deskripsi[1]
            ]
        ]);

        return back();
    }
}
