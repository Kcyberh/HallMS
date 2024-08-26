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
        Schema::create('keylogs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('key_room_id')->constrained('key_room')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('set null');
            $table->string('action'); // e.g., 'issued', 'returned', 'lost'
            $table->text('details')->nullable(); // Additional information, e.g., reason for loss
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keylogs');
    }
};
