<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama harus diisi.',
            'name.string' => 'Nama harus berupa karakter yang valid.',
            'name.max' => 'Nama maksimal berisi 255 karakter.',
            'username.required' => 'Username harus diisi.',
            'username.string' => 'Username harus berupa karakter yang valid.',
            'username.max' => 'Username maksimal berisi 255 karakter.',
            'username.unique' => 'Username sudah terdaftar.',
            'email.required' => 'Email harus diisi.',
            'email.string' => 'Email harus berupa karakter yang valid.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email maksimal berisi 255 karakter.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Kata sandi harus diisi.',
            'password.string' => 'Kata sandi harus berupa karakter yang valid.',
            'password.min' => 'Kata sandi minimal berisi 8 karakter.',
            'password.confirmed' => 'Kata sandi tidak sama.',
        ];
    }
}
