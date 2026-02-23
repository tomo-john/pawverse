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
        Schema::create('dog_action_logs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('dog_id')->constrained()->cascadeOnDelete();
            $table->string('action');
            $table->json('payload');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dog_action_logs');
    }
};
