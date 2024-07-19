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
        Schema::table('data_presensi', function (Blueprint $table) {
            $table->unsignedBigInteger('peserta_id')->nullable();
            $table->foreign('peserta_id')->references('id')->on('data_peserta');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_presensi', function (Blueprint $table) {
            //
        });
    }
};
