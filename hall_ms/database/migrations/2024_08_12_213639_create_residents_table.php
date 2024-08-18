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
        Schema::create('residents', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('guardian_name');
            $table->string('guardian_phone');
            $table->string('guardian_address');
            $table->string('occupation');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('booking_id')->constrained('bookings');
            $table->foreignId('payment_id')->constrained('payments');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('residents');
    }
};
