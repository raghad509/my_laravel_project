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
        Schema::create('community_messages', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->BIGINTUNSIGNED('message_id');
            $table->BIGINTUNSIGNED('sender_id');
            $table->BIGINTUNSIGNED('receiver_id');
            $table->TEXT('message');
            $table->timestamp('sent_at')->default();
            $table->BOOLEAN('is_read')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('community_messages');
    }
};
