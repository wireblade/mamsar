<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AttendanceCutoff extends Model
{
    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'uploaded_by',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
        ];
    }

    public function records(): HasMany
    {
        return $this->hasMany(
            AttendanceRecord::class,
            'attendance_cutoff_id',
            'id'
        );
    }

    public function uploader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
