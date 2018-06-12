<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('author');
            $table->string('author_email');
            $table->integer('theme_id')->unsigned();
            $table->integer('status_id')->unsigned();
            $table->integer('user_id')->unsigned()->nullable();
            $table->text('name');
            $table->timestamp('question_created')->useCurrent();
            $table->timestamp('answer_created')->nullable();
            $table->timestamp('answer_updated')->nullable();
            $table->text('answer')->nullable();
            $table->foreign('theme_id')->references('id')->on('themes');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
