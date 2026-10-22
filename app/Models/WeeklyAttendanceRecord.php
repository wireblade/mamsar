<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WeeklyAttendanceRecord extends Model
{
    protected $fillable = [
        'weekly_attendance_week_id',
        'ac_no',
        'employee_name',
        'attendance_date',
        'clock_in_1',
        'clock_out_1',
        'clock_in_2',
        'clock_out_2',
        'late_minutes_morning',
        'late_minutes_afternoon',
        'total_late_minutes',
        'total_minutes_worked',
        'is_half_day',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'attendance_date' => 'date',
            'is_half_day' => 'boolean',
        ];
    }

    public function week(): BelongsTo
    {
        return $this->belongsTo(WeeklyAttendanceWeek::class, 'weekly_attendance_week_id');
    }
}
