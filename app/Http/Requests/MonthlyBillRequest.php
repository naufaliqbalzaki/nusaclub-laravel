<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MonthlyBillRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'student_id' => ['required', 'exists:students,id'],
            'bill_month' => ['required', 'integer', 'between:1,12'],
            'bill_year' => ['required', 'integer', 'min:2024'],
            'nominal' => ['required', 'numeric', 'min:0'],
            'diskon' => ['nullable', 'numeric', 'min:0'],
            'jatuh_tempo' => ['required', 'date'],
            'catatan' => ['nullable', 'string'],
            'status' => ['sometimes', 'required', 'in:belum_bayar,cicilan,lunas,lewat_jatuh_tempo,batal'],
        ];
    }
}