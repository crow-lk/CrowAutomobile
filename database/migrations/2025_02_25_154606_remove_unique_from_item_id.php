<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('procurements', function (Blueprint $table) {
            $table->dropUnique(['item_id']); // Remove the unique constraint
        });
    }

    public function down()
    {
        Schema::table('procurements', function (Blueprint $table) {
            $table->unique('item_id'); // Re-add the unique constraint if rolling back
        });
    }
};
