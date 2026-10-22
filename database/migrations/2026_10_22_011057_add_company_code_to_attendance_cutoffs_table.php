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
        Schema::table('attendance_cutoffs', function (Blueprint $table) {
            $table->dropUnique([
                'start_date',
                'end_date',
            ]);

            $table->string('company_code');

            $table->unique([
                'company_code',
                'start_date',
                'end_date',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attendance_cutoffs', function (Blueprint $table) {
            $table->dropUnique([
                'company_code',
                'start_date',
                'end_date',
            ]);

            $table->dropColumn('company_code');

            $table->unique([
                'start_date',
                'end_date',
            ]);
        });
    }
};
