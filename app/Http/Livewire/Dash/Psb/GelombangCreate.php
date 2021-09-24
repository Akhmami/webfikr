<?php

namespace App\Http\Livewire\Dash\Psb;

use App\Models\Gelombang;
use LivewireUI\Modal\ModalComponent;

class GelombangCreate extends ModalComponent
{
    public $nama;
    public $tgl_tes;
    public $tgl_wawancara;
    public $tgl_pengumuman;
    public $batas_pembayaran;
    public $biaya_pendaftaran;
    public $is_active;
    public $datetime_expired;

    protected $rules = [
        'nama' => 'required',
        'tgl_tes' => 'required',
        'tgl_wawancara' => 'required',
        'tgl_pengumuman' => 'required',
        'batas_pembayaran' => 'required',
        'biaya_pendaftaran' => 'required',
        'is_active' => 'required',
        'datetime_expired' => 'required',
    ];

    public function render()
    {
        return view('livewire.dash.psb.gelombang-create');
    }

    public function store()
    {
        $validatedData = $this->validate();
        $gel = Gelombang::create($validatedData);
        if ($validatedData['is_active'] == 'Y') {
            Gelombang::where('id', '<>', $gel->id)->update([
                'is_active' => 'N'
            ]);
        }

        $this->closeModal();
        $this->emit('gelombangIndex');

        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'title' => 'Created!',
            'text' => 'Gelombang Berhasil Ditambahkan',
        ]);
    }
}
