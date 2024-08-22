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
        Schema::table('key_room', function (Blueprint $table) {
            //
            $table->string('status')->default('active'); // Adding the status column
            $table->string('key_number')->nullable(); // Adding the number column (combination of key code and room number)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('key_room', function (Blueprint $table) {
            //
            $table->dropColumn(['status', 'Key_number']);
        });
    }
};
