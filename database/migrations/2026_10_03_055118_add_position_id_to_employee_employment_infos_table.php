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
        Schema::table('employee_employment_infos', function (Blueprint $table) {
            $table->string('id_number')->unique()->nullable();
            $table->foreignId('position_id')->constrained('positions')->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employee_employment_infos', function (Blueprint $table) {
            //
        });
    }
};
