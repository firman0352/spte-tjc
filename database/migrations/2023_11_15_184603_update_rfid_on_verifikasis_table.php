<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('verifikasis', function (Blueprint $table) {
            $table->string('rfid_tag')->unique()->before('timestamps');
            $table->string('location')->nullable()->after('rfid_tag');
        });
    }    

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('verifikasis', function (Blueprint $table) {
            $table->dropColumn('rfid_tag');
        });
    }
};
