<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MonthlyBill extends Model
{
    protected $fillable = [
        'student_id',
        'package_id',
        'bill_month',
        'bill_year',
        'nominal',
        'diskon',
        'total',
        'jatuh_tempo',
        'status',
        'catatan',
    ];

    protected $casts = [
        'nominal' => 'decimal:2',
        'diskon' => 'decimal:2',
        'total' => 'decimal:2',
        'jatuh_tempo' => 'date',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}