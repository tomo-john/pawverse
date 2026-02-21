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
        Schema::create('dog_statuses', function (Blueprint $table) {
            $table->id();

            $table->foreignId('dog_id')->unique()->constrained()->cascadeOnDelete();
            $table->integer('level')->default(1);
            $table->integer('exp')->default(0);
            $table->integer('happy')->default(100);
            $table->integer('stamina')->default(100);
            $table->integer('hunger')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dog_statuses');
    }
};
