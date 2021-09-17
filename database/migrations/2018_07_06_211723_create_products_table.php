<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
      
          $table->increments('id');
            $table->increments('ordering')->nullable;
            
            $table->integer('category_id');
            $table->string('product_name')->nullable;
            $table->string('type',30);
            $table->string('status',10);
            $table->string('photo',300);
            $table->string('recommendation',20);
            $table->string('sku',30);
            $table->string('weight',10);
            $table->string('item',300);
            $table->string('recommendation',20);
            
            $table->text('description');
            $table->double('price_agent')->nullable();;
            $table->double('price_promo');
            $table->double('price_sell');
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
        Schema::dropIfExists('products');
    }
}