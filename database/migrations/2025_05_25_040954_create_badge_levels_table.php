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
        Schema::create('badge_levels', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('akun_id');
            $table->integer('poin')->default(0);
            $table->enum('status', ['Abdi', 'Panewu', 'Adipati', 'Mahapatih', 'Sultan']);
            $table->integer('konten_approved')->default(0);
            $table->boolean('quiz_completed')->default(false);
            $table->integer('quiz_score')->default(0);
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('akun_id')->references('id')->on('akun')->onDelete('cascade');

            // Index for better performance
            $table->index(['akun_id', 'poin']);
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('badge_levels');
    }
};
