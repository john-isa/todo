<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments ('id');
            $table->string     ('title');
            $table->string     ('description');
            $table->boolean    ('done');
            $table->boolean    ('deleted');
            $table->string     ('created');
            $table->timestamp  ('updated') -> default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string     ('expires');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
