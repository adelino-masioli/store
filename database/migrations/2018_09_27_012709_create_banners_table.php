<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('status_id')->nullable();
            $table->foreign('status_id')->references('id')->on('status');
            $table->unsignedInteger('configuration_id')->nullable();
            $table->foreign('configuration_id')->references('id')->on('configurations');
            $table->string('name');
            $table->text('description');
            $table->string('file');
            $table->string('extension');
            $table->string('size');
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
        Schema::dropIfExists('banners');
    }
}
