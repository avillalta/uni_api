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
        Schema::create('signatures', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->json('units')->nullable();
            $table->json('schedule')->nullable();
            $table->foreignId('semester_id')->nullable(); 
            $table->foreign('semester_id')
                ->references('id')
                ->on('semesters')
                ->nullOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('professor_id')->nullable();
            $table->foreign('professor_id')
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
        Schema::table('signatures', function (Blueprint $table) {
            
            $table->dropForeign(['semester_id']);
            $table->dropForeign(['professor_id']);
        });

        Schema::dropIfExists('signatures');
    }
};
