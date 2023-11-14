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
        Schema::create('progress', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('order_id')->constrained('orders');
            $table->json('in_production')->nullable();
            $table->json('product_finished')->nullable();
            $table->json('product_packing')->nullable();
            $table->json('product_container')->nullable();
            $table->string('lab_test_document')->nullable();
            $table->string('shipping_document')->nullable();
            $table->string('bill_of_lading')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progress');
    }
};
