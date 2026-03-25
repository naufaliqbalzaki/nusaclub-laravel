<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'monthly_bill_id' => ['required', 'exists:monthly_bills,id'],
            'tanggal_bayar' => ['required', 'date'],
            'nominal_bayar' => ['required', 'numeric', 'min:1'],
            'metode_pembayaran' => ['required', 'in:transfer,cash,qris'],
            'reference_no' => ['nullable', 'string', 'max:255'],
            'catatan' => ['nullable', 'string'],
            'bukti_bayar' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
        ];
    }
}