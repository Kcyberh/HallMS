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
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('gender');
            $table->integer('age');
            $table->integer('telephone');
            $table->string('department');
            $table->string('level');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('gender');
            $table->dropColumn('age');
            $table->dropColumn('telephone');
            $table->dropColumn('department');
            $table->dropColumn('level');
        });
    }
};
