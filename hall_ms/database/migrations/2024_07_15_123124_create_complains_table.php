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
        Schema::create('complains', function (Blueprint $table) {
            $table->id();
            $table->timestamp('time_date');
            $table->text('statement');
            $table->foreignId('student_id')->constrained('students');
            $table->foreignId('room_id')->constrained('rooms');
            $table->foreignId('hall_id')->constrained('halls');
                       
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complains');
    }
};
