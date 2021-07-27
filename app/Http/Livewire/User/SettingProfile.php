<?php

namespace App\Http\Livewire\User;

use Livewire\Component;

class SettingProfile extends Component
{
    public $username;
    public $bio;
    public $name;
    public $gender;
    public $email;
    public $birth_place;
    public $birth_date;
    public $user_id;

    protected $messages = [
        'username.required' => 'Username tidak boleh kosong',
        'username.min' => 'Username mininal 6 karakter',
        'username.max' => 'Username maksimal 100 karakter',
        'username.unique' => 'Username sudah terpakai, gunakan yang lain',
        'bio.max' => 'Bio maksimal 250 karakter',
        'name.required' => 'Nama lengkap tidak boleh kosong',
        'name.min' => 'Nama lengkap minimal 3 karakter',
        'name.max' => 'Nama lengkap maksimal 150 karakter',
        'gender.required' => 'Jenis kelamin harus dipilih',
        'email.required' => 'Email tidak boleh kosong',
        'email.email' => 'Harus alamat email',
        'birth_place.required' => 'Tempat lahir tidak boleh kosong',
        'birth_date.required' => 'Tanggal lahir tidak boleh kosong'
    ];

    public function mount()
    {
        $user = auth()->user();
        $this->user_id = $user->id;
        $this->username = $user->username;
        $this->bio = $user->bio;
        $this->name = $user->name;
        $this->gender = $user->gender;
        $this->email = $user->email;
        $this->birth_place = $user->birth_place;
        $this->birth_date = $user->birth_date;
    }

    public function render()
    {
        return view('livewire.user.setting-profile');
    }

    public function update()
    {
        $validatedData = $this->validate();
        auth()->user()->update($validatedData);

        $this->emit('openModal', 'alert-modal', [
            'status' => 'success',
            'emit' => 'closeProfileAlertModal',
            'title' => 'Profile Updated',
            'description' => 'Data profile user berhasil diupdate!'
        ]);
    }

    public function rules()
    {
        return [
            'username' => 'required|string|min:6|max:100|unique:users,username,' . $this->user_id,
            'bio' => 'nullable|max:250',
            'name' => 'required|string|min:3|max:150',
            'gender' => 'required',
            'email' => 'required|email',
            'birth_place' => 'required|string',
            'birth_date' => 'required'
        ];
    }
}
