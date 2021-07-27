<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Rules\CurrentPassword;

class SettingPassword extends Component
{
    public $old_password;
    public $password;
    public $password_confirmation;

    protected $messages = [
        'old_password.required' => 'Kata sandi saat ini tidak boleh kosong',
        'password.required' => 'Kata sandi baru tidak boleh kosong',
        'password.min' => 'Kata sandi minimal 8 karakter',
        'password.confirmed' => 'Konfirmasi kata sandi tidak sesuai'
    ];

    public function render()
    {
        return view('livewire.user.setting-password');
    }

    public function change()
    {
        $this->validate();
        auth()->user()->update([
            'password' => bcrypt($this->password)
        ]);

        $this->emit('openModal', 'alert-modal', [
            'status' => 'success',
            'emit' => 'closePasswordAlertModal',
            'title' => 'Password Changed',
            'description' => 'Kata sandi baru berhasil disimpan!'
        ]);
    }

    protected function rules()
    {
        return [
            'old_password' => ['required', new CurrentPassword],
            'password' => ['required', 'confirmed', 'min:8']
        ];
    }
}
