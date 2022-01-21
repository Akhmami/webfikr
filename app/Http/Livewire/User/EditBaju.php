<?php

namespace App\Http\Livewire\User;

use App\Models\Clothes;
use LivewireUI\Modal\ModalComponent;

class EditBaju extends ModalComponent
{
    public $nama;
    public $ukuran;
    public $deskripsi;
    public $baju;

    protected $rules = [
        'ukuran' => 'required',
        'deskripsi' => 'nullable'
    ];

    protected $messages = [
        'ukuran.required' => 'Ukuran harus dipilih',
    ];

    public function mount(Clothes $baju)
    {
        $this->baju = $baju;
        $this->nama = $baju->nama;
        $this->ukuran = $baju->ukuran;
        $this->deskripsi = $baju->deskripsi;
    }

    public function render()
    {
        return view('livewire.user.edit-baju');
    }

    public function update()
    {
        $validatedData = $this->validate();

        $this->baju->update($validatedData);

        return redirect()->route('user.baju');
    }
}
