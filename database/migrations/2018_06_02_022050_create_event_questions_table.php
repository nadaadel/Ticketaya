<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('question');
            $table->string('answer')->nullable();
            $table->integer('event_id');
            $table->integer('user_id');
            $table->timestamps();
            $table->unique(['question']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_questions');
    }
}
