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
        Schema::create('enrollments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->date('enrollment_date');
            $table->foreignId('course_id')->nullable(); 
            $table->foreign('signature_id')
                ->references('id')
                ->on('courses')
                ->nullOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('student_id')->nullable();
            $table->foreign('student_id')
                ->references('id')
                ->on('users')
                ->nullOnDelete()
                ->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('enrollments', function (Blueprint $table) {
            
            $table->dropForeign(['course_id']);
            $table->dropForeign(['student_id']);
        });

        Schema::dropIfExists('enrollments');
    }
};
