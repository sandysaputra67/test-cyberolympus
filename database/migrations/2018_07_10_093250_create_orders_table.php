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
             $table->string('agent_name')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('payment_link')->nullable();
            $table->datetime('payment_date')->nullable();
            $table->string('buy_by')->nullable();
            $table->string('payment_total')->nullable();
            $table->double('payment_final')->nullable();
          
            $table->double('order_weight')->nullable();
            $table->double('order_distance')->default('0');
            $table->integer('delivery_status')->nullable();
            $table->double('delivery_fee')->nullable();
          
            $table->double('order_weight')->nullable();
            
            $table->increments('id');
            $table->integer('coupon_id')->nullable();
            $table->integer('customer_id')->nullable();
            $table->integer('agent_id')->nullable();
            
            $table->integer('user_id')->unsigned();
            $table->mediumText('order_price')->nullable();
            $table->string('status',30)->nullable();
            $table->integer('order_no')->nullable();

            $table->string('delivery_track')->nullable();
            $table->string('delivery_time')->nullable();
            $table->string('delivery_date')->nullable();
            $table->datetime('order_time',15)->nullable();
            $table->string('kelurahan')->nullable();
            

            $table->string('invoice_id',50)->nullable();
            $table->string('address',200)->nullable();
            $table->string('phone',15)->nullable();
            $table->string('name',15)->nullable();
            $table->string('kelurahan')->nullable();
            $table->integer('kecamatan')->nullable();
            $table->string('kota',50)->nullable();
            $table->string('provinsi',200)->nullable();
            $table->string('kode_pos',15)->nullable();
            $table->string('latitude',15)->nullable();
            $table->string('longitude')->nullable();
            $table->integer('agent_id')->nullable();

            $table->string('token')->nullable();

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