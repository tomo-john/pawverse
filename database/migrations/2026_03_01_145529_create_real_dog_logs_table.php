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
        Schema::create('real_dog_logs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('dog_id')->constrained()->cascadeOnDelete();
            $table->string('type');
            $table->integer('value')->nullable();
            $table->string('unit')->nullable();
            $table->string('memo')->nullable();
            $table->timestamp('logged_at');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('real_dog_logs');
    }
};
