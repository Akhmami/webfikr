<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\Api\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'username' => 'required|unique:users|string|max:50',
            'email' => 'required|email|max:255',
            'gender' => 'required|in:L,P',
            'password' => 'required|string|min:8|max:255'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama tidak boleh kosong',
            'name.string' => 'Nama mengandung karakter terlarang',
            'name.max' => 'Nama maksimal 255 karakter',
            'username.required' => 'Username tidak boleh kosong',
            'username.unique' => 'Username tidak tersedia, silahkan gunakan yang lain',
            'username.string' => 'Username mengandung karakter terlarang',
            'username.max' => 'Username maksimal 50 karakter',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Harus berupa email',
            'email.max' => 'Email maksimal 255 karakter',
            'gender.required' => 'Jenis Kelamin tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong',
            'password.string' => 'Password mengandung karakter terlarang',
            'password.min' => 'Password minimal 8 karakter',
            'password.max' => 'Password maksimal 255 karakter'
        ];
    }
}
