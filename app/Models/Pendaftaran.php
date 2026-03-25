<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pendaftaran extends Model
{
    protected $fillable = [
        'nama',
        'whatsapp',
        'usia',
        'program_id',
        'package_id',
        'lokasi',
        'catatan',
        'status',
    ];

    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    public function student(): HasOne
    {
        return $this->hasOne(Student::class);
    }
}