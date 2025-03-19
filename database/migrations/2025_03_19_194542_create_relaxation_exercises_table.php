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
        Schema::create('relaxation_exercises', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->BIGINTUNSIGNED('exercise_id');
            $table->BIGINTUNSIGNED('user_id');
            $table->VARCHAR(225)('title');
            $table->TEXT('description');
            $table->INT('duration');
            $table->DATE('date_assigned');
            $table->timestamp('created_at');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('relaxation_exercises');
    }
};
