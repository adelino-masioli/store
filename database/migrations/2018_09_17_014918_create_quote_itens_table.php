<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuoteItensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quote_itens', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('quote_id')->nullable();
            $table->foreign('quote_id')->references('id')->on('quotes');
            $table->unsignedInteger('product_id')->nullable();
            $table->foreign('product_id')->references('id')->on('products');
            $table->string('product_name')->nullable();
            $table->string('qty')->nullable();
            $table->decimal('price', 10,2)->nullable();
            $table->decimal('subtotal', 10,2)->nullable();
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
        Schema::dropIfExists('quote_itens');
    }
}
