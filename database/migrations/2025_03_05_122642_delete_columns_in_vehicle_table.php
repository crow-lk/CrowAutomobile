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
        Schema::table('vehicles', function (Blueprint $table) {
            // Drop the existing 'brand' column
            $table->dropColumn('brand');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('vehicles', function (Blueprint $table) {
            // Re-add the 'brand' column
            $table->string('brand')->after('number');
        });
    }
};
