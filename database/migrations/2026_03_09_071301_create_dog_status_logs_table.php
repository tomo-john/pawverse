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

            $table->foreignId('dog_id')->constrained()->constrained();
            $table->morphs('source');
            $table->string('reason')->nullable();
            $table->string('status_type');
            $table->integer('delta');

            $table->timestamps();

            // 検索・集計高速化
            $table->index(['dog_id', 'status_type']);
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
