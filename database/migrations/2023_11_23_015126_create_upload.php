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
        Schema::create('upload', function (Blueprint $table) {
            $table->id();
            $table->string('undangan');
            $table->string('presensi');
            $table->string('dokumentasi');
            $table->unsignedBigInteger('notula_id');
            $table->foreign('notula_id')->references('id')->on('buat_notula')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('upload');
    }
};
