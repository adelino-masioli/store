<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('status_id')->nullable();
            $table->foreign('status_id')->references('id')->on('status');
            $table->unsignedInteger('configuration_id')->nullable();
            $table->foreign('configuration_id')->references('id')->on('configurations');
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedInteger('customer_id')->nullable();
            $table->foreign('customer_id')->references('id')->on('users');
            $table->string('origin');
            $table->integer('type');
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('about')->nullable();
            $table->text('description')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('address')->nullable();
            $table->string('district')->nullable();
            $table->string('number')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->decimal('total', 10,2)->nullable();
            $table->decimal('discount', 10,2)->nullable();
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
        Schema::dropIfExists('orders');
    }
}
