<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PackageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'program_id' => ['nullable', 'exists:programs,id'],
            'nama' => ['required', 'string', 'max:255'],
            'tipe_tagihan' => ['required', 'in:monthly,one_time,per_session'],
            'harga' => ['required', 'numeric', 'min:0'],
            'durasi' => ['nullable', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'jadwal' => ['nullable', 'string'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }
}