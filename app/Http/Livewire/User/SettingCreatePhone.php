<?php

namespace App\Http\Livewire\User;

use App\Models\CountryCode;
use LivewireUI\Modal\ModalComponent;

class SettingCreatePhone extends ModalComponent
{
    public $name;
    public $country_code;
    public $number;
    public $is_first;

    protected $rules = [
        'name' => 'required',
        'country_code' => 'required',
        'number' => 'required'
    ];

    protected $messages = [
        'name.required' => 'Nama Pemilik tidak boleh kosong',
        'country_code.required' => 'Kode negara harus dipilih',
        'number.required' => 'Nomor HP harus diisi!'
    ];

    public function render()
    {
        return view('livewire.user.setting-create-phone', [
            'countries' => CountryCode::pluck('iso', 'phonecode')
        ]);
    }

    public function create()
    {
        if (auth()->user()->mobilePhones()->count() < 3) {
            $validatedData = $this->validate();
            $validatedData['is_first'] = 'N';
            auth()->user()->mobilePhones()->create($validatedData);

            $this->emit('openModal', 'alert-modal', [
                'status' => 'success',
                'emit' => 'closePhoneAlertModal',
                'title' => 'Phone Number Created',
                'description' => 'Nomor telephon berhasil dibuat!'
            ]);
        } else {
            $this->emit('openModal', 'user.alert-modal', ['message' => 'Nomor HP sudah melebihi 2 nomor yang diperbolehkan!']);
        }
    }
}
