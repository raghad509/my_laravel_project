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
        Schema::create('educational_resources', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->BIGINTUNSIGNED('resource_id');
            $table->BIGINTUNSIGNED('tip_id');
            $table->VARCHAR(225)('title');
            $table->TEXT ('description');
            $table->VARCHAR(225)('link');
            $table->timestamps('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('educational_resources');
    }
};
