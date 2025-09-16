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
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->date('attendance_date');
            $table->time('am_time_in')->nullable();
            $table->time('am_time_out')->nullable();
            $table->time('pm_time_in')->nullable();
            $table->time('pm_time_out')->nullable();
            $table->enum('status', ['present', 'absent', 'partial'])->default('absent');
            $table->text('notes')->nullable();
            $table->timestamps();
            
            // Ensure one record per student per day
            $table->unique(['student_id', 'attendance_date']);
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
