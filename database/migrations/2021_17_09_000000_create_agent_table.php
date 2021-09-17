<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent', function (Blueprint $table) {
            $table->increment('id');
            $table->string('store_name');
            $table->string('partner_id')->nullable();
            $table->varchar('pin_lock')->nullable();
            $table->time('store_open')->nullable();
            $table->time('store_close')->nullable();
            $table->varchar('address')->nullable();
            $table->varchar('kelurahan')->nullable();
            $table->varchar('kecamatan')->nullable();
            $table->varchar('kota')->nullable();
            $table->varchar('provinsi')->nullable();
            $table->varchar('buku_rekening')->nullable();
            $table->varchar('kode_pos')->nullable();
            $table->varchar('latitude')->nullable();
            $table->varchar('longitude')->nullable();
            $table->varchar('npwp')->nullable();
            $table->varchar('no_rekening')->nullable();
            $table->varchar('ktp')->nullable();
            $table->varchar('kk')->nullable();
            $table->varchar('point')->nullable();
            $table->varchar('credit_limit')->nullable();
            $table->varchar('subscription')->nullable();
            $table->integer('max_load')->nullable();
            $table->integer('default_agent')->nullable()-default('0');
           
         
         
        
          

           
           
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agent');
    }
}
