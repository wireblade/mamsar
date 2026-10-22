<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('weekly_attendance_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('weekly_attendance_week_id')
                ->constrained('weekly_attendance_weeks')
                ->cascadeOnDelete();
            $table->string('ac_no', 20);
            $table->string('employee_name');

            $table->date('attendance_date');

            $table->time('clock_in_1')->nullable();
            $table->time('clock_out_1')->nullable();
            $table->time('clock_in_2')->nullable();
            $table->time('clock_out_2')->nullable();

            $table->integer('late_minutes_morning')->default(0);
            $table->integer('late_minutes_afternoon')->default(0);
            $table->integer('total_late_minutes')->default(0);

            $table->integer('total_minutes_worked')->default(0);

            $table->boolean('is_half_day')->default(false);
            $table->string('status', 30)->nullable();

            $table->timestamps();
            $table->unique(
                [
                    'weekly_attendance_week_id',
                    'ac_no',
                    'attendance_date',
                ],
                'weekly_attendance_records_week_employee_date_unique'
            );

            $table->index(['attendance_date', 'employee_name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weekly_attendance_records');
    }
};
