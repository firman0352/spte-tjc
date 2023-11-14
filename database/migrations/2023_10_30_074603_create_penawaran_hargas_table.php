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
        Schema::create('penawaran_hargas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('pengajuan_id')->references('id')->on('pengajuans')->onDelete('restrict')->onUpdate('cascade')->unique();
            $table->foreignId('status_id')->references('id')->on('status_pengajuans')->onDelete('restrict')->onUpdate('cascade');
            $table->string('harga');
            $table->string('keterangan')->nullable();
            $table->string('dokumen')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penawaran_hargas');
    }
};
