<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordersdetail', function (Blueprint $table) {
         
         
            
            `total_price` double DEFAULT NULL
            $table->increments('id');
            $table->integer('product_id')->nullable();
            $table->integer('customer_id')->nullable();
            $table->integer('order_id')->nullable();
            $table->integer('qty')->nullable();
            $table->double('price')->unsigned();
            $table->double('price_agent')->nullable();
            $table->double('total_price')->nullable();       
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
        Schema::dropIfExists('ordersdetail');
    }
}