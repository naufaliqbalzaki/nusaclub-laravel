<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $fillable = [
        'monthly_bill_id',
        'student_id',
        'tanggal_bayar',
        'nominal_bayar',
        'metode_pembayaran',
        'reference_no',
        'catatan',
        'bukti_bayar',
        'diterima_oleh',
    ];

    protected $casts = [
        'tanggal_bayar' => 'date',
        'nominal_bayar' => 'decimal:2',
    ];

    public function monthlyBill(): BelongsTo
    {
        return $this->belongsTo(MonthlyBill::class);
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function receiver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'diterima_oleh');
    }

    public function getBuktiBayarUrlAttribute(): ?string
    {
        return $this->bukti_bayar
            ? asset('storage/' . $this->bukti_bayar)
            : null;
    }
}