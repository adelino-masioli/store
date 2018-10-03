<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupportAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('support_answers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('support_id')->nullable();
            $table->foreign('support_id')->references('id')->on('supports');
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('name');
            $table->text('description');
            $table->string('file')->nullable();
            $table->string('extension')->nullable();
            $table->string('size')->nullable();
            $table->integer('click')->nullable();
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
        Schema::dropIfExists('support_answers');
    }
}
