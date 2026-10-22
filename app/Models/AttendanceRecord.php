<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AttendanceRecord extends Model
{
    protected $fillable = [
        'attendance_cutoff_id',
        'ac_no',
        'employee_name',
        'attendance_date',
        'clock_in_1',
        'clock_out_1',
        'clock_in_2',
        'clock_out_2',
        'morning_worked',
        'afternoon_worked',
        'total_worked',
        'late_minutes',
        'is_half_day',
        'status',
        'late_minutes_morning',
        'late_minutes_afternoon',
    ];

    protected function casts(): array
    {
        return [
            'attendance_date' => 'date',
            'is_half_day' => 'boolean',
            'morning_worked' => 'integer',
            'afternoon_worked' => 'integer',
            'total_worked' => 'integer',
            'late_minutes' => 'integer',
            'late_minutes_morning' => 'integer',
            'late_minutes_afternoon' => 'integer',
        ];
    }

    public function cutoff(): BelongsTo
    {
        return $this->belongsTo(AttendanceCutoff::class, 'attendance_cutoff_id');
    }
}
