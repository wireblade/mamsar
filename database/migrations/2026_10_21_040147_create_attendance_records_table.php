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
        Schema::create('attendance_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attendance_cutoff_id')
                ->constrained('attendance_cutoffs')
                ->cascadeOnDelete();

            $table->string('ac_no');
            $table->string('employee_name');
            $table->date('attendance_date');

            $table->time('clock_in_1')->nullable();
            $table->time('clock_out_1')->nullable();
            $table->time('clock_in_2')->nullable();
            $table->time('clock_out_2')->nullable();

            $table->unsignedInteger('morning_worked')->default(0);
            $table->unsignedInteger('afternoon_worked')->default(0);
            $table->unsignedInteger('total_worked')->default(0);
            $table->unsignedInteger('late_minutes')->default(0);

            $table->boolean('is_half_day')->default(false);
            $table->string('status', 20)->default('ABSENT');
            $table->timestamps();

            // One record per employee per attendance date per cutoff.
            $table->unique(
                ['attendance_cutoff_id', 'ac_no', 'attendance_date'],
                'attendance_records_cutoff_employee_date_unique'
            );

            $table->index(['attendance_cutoff_id', 'attendance_date']);
            $table->index(['attendance_cutoff_id', 'employee_name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance_records');
    }
};
