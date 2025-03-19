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
        Schema::create('diet_and_habits', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->BIGINTUNSIGNED('diet_id');
            $table->BIGINTUNSIGNED('user_id');
            $table->DATE('date');
            $table->TEXT('diet_description')->nullable();
            $table->TEXT('bad_habits')->nullable();
            $table->timestamp('created_at')->default();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diet_and_habits');
    }
};
    