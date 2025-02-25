<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeQtyColumnTypeInItemsTable extends Migration
{
    public function up()
    {
        Schema::table('items', function (Blueprint $table) {
            // Change the 'qty' column from string to integer
            $table->integer('qty')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('items', function (Blueprint $table) {
            // Rollback the change, changing back to string
            $table->string('qty')->nullable()->change();
        });
    }
}
