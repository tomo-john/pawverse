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
        Schema::create('dog_status_logs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('dog_id')->constrained()->cascadeOnDelete();
            $table->morphs('source');
            $table->string('status_type');
            $table->integer('delta');

            $table->timestamps();

            // タイムライン用
            $table->index(['dog_id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dog_status_logs');
    }
};
