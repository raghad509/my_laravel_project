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
            $table->timestamps();
            $table->BIGINTUNSIGNED('questionnaire_id');
            $table->BIGINTUNSIGNED('user_id');
            $table->DATE('date');
            $table->TINYINT('anxiety_level');
            $table->TINYINT('stress_level');
            $table->VARCHAR(50)('symptoms_frequency');
            $table->VARCHAR(50)('symptoms_severity');
            $table->TEXT('physical_symptoms');
            $table->TEXT('psychological_symptoms');
            $table->TEXT('triggers');
            $table->TEXT('coping_strategy');
            $table->TEXT('daily_life_impact');
            $table->TEXT('support_needs');
            $table->timestamp('created_at');




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
