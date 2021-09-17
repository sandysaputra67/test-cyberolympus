<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Createproducts_categoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_category', function (Blueprint $table) {
     
   
          $table->increments('id');
            $table->increments('ordering')->nullable;
        
            $table->string('name')->nullable;
            $table->integer('parent_id')->nullable;
            $table->string('icon')->nullable;
            $table->string('icon_web')->nullable;
          
            $table->integer('status')->nullable;
            $table->integer('ordering')->nullable;
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
        Schema::dropIfExists('products_category');
    }
}