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
        Schema::table('verifikasis', function (Blueprint $table) {
            $table->after('inspektur_id', function ($table) {
                $table->foreignUuid('inspektur2_id')->constrained('inspekturs')->cascadeOnDelete()->cascadeOnUpdate();
            });
            $table->string('comment')->nullable();
            $table->string('rejecting_inspektur')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('verifikasis', function (Blueprint $table) {
            $table->dropForeign(['inspektur2_id']);
        });
    }
};
