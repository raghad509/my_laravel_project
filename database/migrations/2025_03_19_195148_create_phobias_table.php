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
        Schema::create('phobias', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->BIGINTUNSIGNED('phobia_id');
            $table->BIGINTUNSIGNED('user_id');
            $table->VARCHAR(100)('phobia_name');
            $table->TEXT('description');
            $table->TINYINT('progress');
            $table->timestamp('created_at');
            

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phobias');
    }
};
