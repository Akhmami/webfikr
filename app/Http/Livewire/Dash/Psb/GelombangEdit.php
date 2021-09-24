<?php

namespace App\Http\Livewire\Dash\Psb;

use App\Models\Gelombang;
use LivewireUI\Modal\ModalComponent;

class GelombangEdit extends ModalComponent
{
    public $nama;
    public $tgl_tes;
    public $tgl_wawancara;
    public $tgl_pengumuman;
    public $batas_pembayaran;
    public $biaya_pendaftaran;
    public $is_active;
    public $datetime_expired;
    public $gelombang;

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

    public function mount(Gelombang $gelombang)
    {
        $this->gelombang = $gelombang;
        $this->nama = $gelombang->nama;
        $this->tgl_tes = $gelombang->tgl_tes;
        $this->tgl_wawancara = $gelombang->tgl_wawancara;
        $this->tgl_pengumuman = $gelombang->tgl_pengumuman;
        $this->batas_pembayaran = $gelombang->batas_pembayaran;
        $this->biaya_pendaftaran = $gelombang->biaya_pendaftaran;
        $this->is_active = $gelombang->is_active;
        $this->datetime_expired = $gelombang->datetime_expired;
    }

    public function render()
    {
        return view('livewire.dash.psb.gelombang-edit');
    }

    public function update()
    {
        $validatedData = $this->validate();
        if ($validatedData['is_active'] == 'Y') {
            Gelombang::where('id', '<>', $this->gelombang->id)->update([
                'is_active' => 'N'
            ]);
        }

        $this->gelombang->update($validatedData);

        $this->closeModal();
        $this->emit('gelombangIndex');

        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'title' => 'Updated!',
            'text' => 'Gelombang Berhasil Diupdate',
        ]);
    }
}
