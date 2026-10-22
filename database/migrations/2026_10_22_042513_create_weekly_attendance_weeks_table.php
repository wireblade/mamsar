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
        Schema::create('weekly_attendance_weeks', function (Blueprint $table) {
            $table->id();
            $table->string('company_code', 10);
            $table->date('start_date');
            $table->date('end_date');
            $table->string('name')->nullable();

            $table->foreignId('uploaded_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();
            $table->timestamps();
            $table->unique(
                ['company_code', 'start_date', 'end_date'],
                'weekly_attendance_weeks_company_dates_unique'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weekly_attendance_weeks');
    }
};
