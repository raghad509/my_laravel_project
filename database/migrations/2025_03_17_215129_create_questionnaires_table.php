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
        Schema::create('questionnaires', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->date('date');
            $table->integer('anxiety_level');
            $table->integer('stress_level');
            $table->string('symptoms_frequency');
            $table->string('symptoms_severity');
            $table->text('physical_symptoms');
            $table->text('psychological_symptoms');
            $table->text('triggers');
            $table->text('coping_strategy');
            $table->text('daily_life_impact');
            $table->text('support_needs');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questionnaires');
    }
};
