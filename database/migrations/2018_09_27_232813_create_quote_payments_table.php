<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quote_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('quote_id')->nullable();
            $table->foreign('quote_id')->references('id')->on('quotes');
            $table->unsignedInteger('payment_id')->nullable();
            $table->foreign('payment_id')->references('id')->on('payments');
            $table->decimal('price', 10,2)->nullable();
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
        Schema::dropIfExists('quote_payments');
    }
}
