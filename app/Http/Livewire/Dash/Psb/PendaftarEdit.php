<?php

namespace App\Http\Livewire\Dash\Psb;

use App\Models\LokasiTest;
use App\Models\MedicalCheck;
use App\Models\User;
use LivewireUI\Modal\ModalComponent;

class PendaftarEdit extends ModalComponent
{
    public $name;
    public $email;
    public $gender;
    public $birth_date;
    public $birth_place;
    public $nisn;
    public $nik;
    public $jenjang;
    public $jurusan_pilihan;
    public $npsn;
    public $lokasi_test_id;
    public $medical_check_id;
    public $list_jk;
    public $list_jenjang;
    public $list_jurusan;
    public $lokasi_test;
    public $medical_check;
    public $user;

    protected $rules = [
        'name' => 'required|min:3|max:200',
        'email' => 'required|email',
        'gender' => 'required',
        'birth_place' => 'required|min:3|max:100',
        'birth_date' => 'required|date_format:Y-m-d',
        'lokasi_test_id' => 'required',
        'medical_check_id' => 'nullable',
        'nisn' => 'required|min:10|max:10',
        'nik' => 'required|min:16|max:16',
        'jenjang' => 'required',
        'npsn' => 'required|min:6|max:8'
    ];

    public function mount(User $user)
    {
        $this->user = $user;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->gender = $user->gender;
        $this->birth_date = $user->birth_date;
        $this->birth_place = $user->birth_place;
        $this->nisn = $user->userDetail->nisn;
        $this->nik = $user->userDetail->nik;
        $this->jenjang = $user->userDetail->jenjang;
        $this->jurusan_pilihan = $user->userDetail->jurusan_pilihan;
        $this->npsn = $user->userDetail->npsn;
        $this->lokasi_test_id = $user->lokasi_test_id;
        $this->medical_check_id = $user->medical_check_id;

        $this->list_jk = ['L' => 'Laki-laki', 'P' => 'Perempuan'];
        $this->list_jenjang = ['SMP' => 'SMP Islam Nurul Fikri Serang', 'SMA' => 'SMA Islam Nurul Fikri Serang'];
        $this->list_jurusan = ['IPA' => 'IPA', 'IPS' => 'IPS', 'IPC' => 'IPA/IPS'];
        $this->lokasi_test = LokasiTest::pluck('lokasi', 'id');
        $this->medical_check = MedicalCheck::pluck('title', 'id');
    }

    public function render()
    {
        return view('livewire.dash.psb.pendaftar-edit');
    }

    public function update()
    {
        $validatedData = $this->validate();
        $this->user->update($validatedData);
        $this->user->userDetail()->update([
            'nisn' => $validatedData['nisn'],
            'nik' => $validatedData['nik'],
            'jenjang' => $validatedData['jenjang'],
            'npsn' => $validatedData['npsn']
        ]);

        $this->closeModal();

        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'title' => 'Updated!',
            'text' => 'Data Berhasil Diupdate',
        ]);
    }
}
