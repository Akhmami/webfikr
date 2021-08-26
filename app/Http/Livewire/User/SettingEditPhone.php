<?php

namespace App\Http\Livewire\User;

use App\Models\CountryCode;
use App\Models\MobilePhone;
use LivewireUI\Modal\ModalComponent;

class SettingEditPhone extends ModalComponent
{
    public $phone;
    public $name;
    public $number;
    public $country_code;

    protected $rules = [
        'name' => 'required',
        'country_code' => 'required',
        'number' => 'required',
    ];

    protected $messages = [
        'name.required' => 'Nama Pemilik tidak boleh kosong',
        'country_code.required' => 'Kode negara harus dipilih',
        'number.required' => 'Nomor HP harus diisi!'
    ];

    public function mount(MobilePhone $phone)
    {
        $this->phone = $phone;
        $this->name = $phone->name;
        $this->number = $phone->number;
        $this->country_code = $phone->country_code;
    }

    public function render()
    {
        return view('livewire.user.setting-edit-phone', [
            'countries' => CountryCode::pluck('iso', 'phonecode')
        ]);
    }

    public function update()
    {
        $validatedData = $this->validate();

        $this->phone->update($validatedData);

        $this->emit('openModal', 'alert-modal', [
            'status' => 'success',
            'emit' => 'closePhoneAlertModal',
            'title' => 'Phone Number Updated',
            'description' => 'Nomor telephon berhasil diupdate!'
        ]);
    }
}
