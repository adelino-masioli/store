<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_notes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('contact_id')->nullable();
            $table->foreign('contact_id')->references('id')->on('contacts');
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedInteger('status_id')->nullable();
            $table->foreign('status_id')->references('id')->on('status');
            $table->text('note')->nullable();
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
        Schema::dropIfExists('contact_notes');
    }
}
