<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('konten', function (Blueprint $table) {
            $table->id();
            $table->string('thumbnail')->nullable();
            $table->string('judul');
            $table->text('isi');
            $table->enum('kategori', ['tarian', 'musik', 'kuliner', 'upacara', 'kerajinan', 'situs budaya']);
            $table->enum('status', ['rejected', 'pending', 'approved']);
            $table->string('asal');
            $table->unsignedBigInteger('akun_id');
            $table->integer('views_count')->default(0);
            $table->timestamps();

            $table->foreign('akun_id')->references('id')->on('akun')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('konten');
    }
};
