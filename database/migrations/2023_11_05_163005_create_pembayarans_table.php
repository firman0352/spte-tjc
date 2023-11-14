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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('order_id')->unique()->constrained('orders');
            $table->string('pembayaran_term1');
            $table->string('pembayaran_term2');
            $table->string('pembayaran_term3');
            $table->string('dokumen_bukti_term1')->nullable();
            $table->string('dokumen_bukti_term2')->nullable();
            $table->string('dokumen_bukti_term3')->nullable();
            $table->string('invoice_term1')->nullable();
            $table->string('invoice_term2')->nullable();
            $table->string('invoice_term3')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
