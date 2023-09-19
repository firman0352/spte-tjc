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
        Schema::create('verifikasis', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('dokumen_customer_id')->constrained('dokumen_customers')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignUuid('inspektur_id')->constrained('inspekturs')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('status_id')->constrained('status_dokumens')->restrictOnDelete()->cascadeOnUpdate();
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verifikasis');
    }
};
