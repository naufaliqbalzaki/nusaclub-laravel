<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
            'alamat' => ['nullable', 'string'],
            'program_id' => ['nullable', 'exists:programs,id'],
            'package_id' => ['nullable', 'exists:packages,id'],
            'tanggal_mulai' => ['required', 'date'],
            'status' => ['required', 'in:aktif,nonaktif,cuti'],
            'catatan' => ['nullable', 'string'],
        ];
    }
}