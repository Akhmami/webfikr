<?php

namespace App\Http\Livewire\Dash\Users;

use LivewireUI\Modal\ModalComponent;
use Spatie\Permission\Models\Role;
use App\Models\User;

class UserCreate extends ModalComponent
{
    public $name;
    public $username;
    public $email;
    public $password;
    public $password_confirmation;
    public $roles = [];

    protected $rules = [
        'name' => 'required|min:3|max:150',
        'username' => ['required', 'string', 'unique:users', 'not_regex:/^(root|admin|super-admin|administrator)$/i'],
        'email' => 'required|email',
        'password' => 'required|string|confirmed|min:8',
        'roles' => 'nullable'
    ];

    protected $messages = [
        'name.required' => 'Nama lengkap tidak boleh kosong',
        'name.min' => 'Nama lengkap minimal 3 karakter',
        'name.max' => 'Nama lengkap maksimal 150 karakter',
        'email.required' => 'Email tidak boleh kosong',
        'email.email' => 'Alamat email tidak valid',
        'username.required' => 'Username tidak boleh kosong',
        'username.string' => 'Username mengandung karakter terlarang',
        'username.unique' => 'Username sudah ada yang make',
        'username.not_regex' => 'Username tidak valid',
        'password.required' => 'Password tidak boleh kosong',
        'password.string' => 'Password mengandung karakter terlarang',
        'password.confirmed' => 'Konfirmasi password tidak sesuai',
        'password.min' => 'Password minimal 8 karakter'
    ];

    public function render()
    {
        return view('livewire.dash.users.user-create', [
            'all_roles' => Role::where('name', '<>', 'user')->get()
        ]);
    }

    public function create()
    {
        $validatedData = $this->validate();
        $validatedData['password'] = bcrypt($this->password);
        $user = User::create($validatedData);
        $user->assignRole($this->roles);

        $this->emit('openModal', 'alert-modal', [
            'status' => 'success',
            'emit' => 'closeUserAlertModal',
            'title' => 'User Created',
            'description' => 'Data user yang dipilih berhasil dibuat!'
        ]);
    }
}
