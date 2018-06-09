<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->string('photo')->default('default.jpg');;
            $table->integer('category_id')->unsigned()->index()->nullable();
            $table->integer('avaliabletickets');
            $table->DateTime('startdate');
            $table->DateTime('enddate');
            $table->integer('user_id')->unsigned()->index()->nullable();
            $table->integer('region_id')->unsigned()->index()->nullable();
            $table->integer('city_id')->unsigned()->index()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
