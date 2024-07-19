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
        Schema::create('data_presensi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('notula_id');
            $table->foreign('notula_id')->references('id')->on('buat_notula');
            $table->integer('jumlah_hadir')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_presensi');
    }
};
