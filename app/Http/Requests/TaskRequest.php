<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
            'workspace_id' => 'required|exists:workspaces,id',
            'user_id' => 'nullable|exists:users,id',
            'due_date' => 'nullable|date|after_or_equal:today',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama task harus diisi.',
            'name.string' => 'Nama task harus berupa string.',
            'name.max' => 'Nama task tidak boleh lebih dari 255 karakter.',
            'workspace_id.required' => 'ID workspace harus diisi.',
            'workspace_id.exists' => 'ID workspace tidak ditemukan.',
            'user_id.exists' => 'ID user tidak ditemukan.',
            'due_date.date' => 'Format tanggal tidak valid.',
        ];
    }
}
