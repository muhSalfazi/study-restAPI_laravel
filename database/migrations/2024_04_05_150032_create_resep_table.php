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
        Schema::create('resep', function (Blueprint $table) {
            $table->id('idresep');
            $table->string('judul');
            $table->string('gambar');
            $table->text('cara_pembuatan')->nullable();
            $table->string('video');
            $table->string('user_email');
            $table->foreign('user_email')->references('email')->on('user')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('status_resep',['draft','submit','publish','unpublished'])->defaul('draft') ;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resep');
    }
};