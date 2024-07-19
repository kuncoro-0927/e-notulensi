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
        Schema::create('buat_notula', function (Blueprint $table) {
            $table->id('id');
            $table->string('topik_rapat');
            $table->string('pemimpin_rapat');
            $table->dateTime('waktu_rapat');
            $table->string('tempat_rapat');
            $table->string('notulensi_rapat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buat_notula');
    }
};
