<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PendaftaranRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama' => ['required', 'string', 'max:255'],
            'whatsapp' => ['required', 'string', 'max:25'],
            'usia' => ['required', 'integer', 'min:4'],
            'program_id' => ['nullable', 'exists:programs,id'],
            'lokasi' => ['required', 'string', 'max:255'],
            'catatan' => ['nullable', 'string'],
        ];
    }
}