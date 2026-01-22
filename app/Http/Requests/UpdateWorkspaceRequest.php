<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWorkspaceRequest extends FormRequest
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
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'name.string' => 'Nama workspace harus berupa karakter yang valid',
            'name.max' => 'Nama workspace maksimal 255 karakter',
            'description.max' => 'Deskripsi maksmimal 255 karakter',
        ];
    }
}
