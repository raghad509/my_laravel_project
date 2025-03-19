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
        Schema::create('specialist_communications', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->BIGINTUNSIGNED('communication_id');
            $table->BIGINTUNSIGNED('user_id');
            $table->BIGINTUNSIGNED('specialist_id');
            $table->DATE('communication_date');
            $table->TEXT('meesage')->nullable();
            $table->timestamp('created_at')->default();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('specialist_communications');
    }
};
