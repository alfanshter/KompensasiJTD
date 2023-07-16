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
        Schema::create('kompens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->date('tanggal');
            $table->time('waktu');
            $table->foreignId('kegiatan_id');
            $table->foreign('kegiatan_id')->references('id')->on('kegiatans')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('jam')->default(0);
            $table->string('dosen')->nullable();
            $table->string('keterangan')->nullable();
            $table->dateTime('tanggal_absen')->nullable();
            $table->dateTime('tanggal_selesai')->nullable();
            $table->integer('is_status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kompens');
    }
};
