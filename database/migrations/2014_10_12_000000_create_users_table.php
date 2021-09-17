<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->integerIncrements('id')->start_from(50000);
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('pin')->nullable();
            $table->string('phone')->nullable();
            $table->dateTime('phone_verified_at')->nullable();
            $table->integer('account_type')->nullable();
            $table->string('account_role')->nullable();
            $table->string('photo')->nullable();
            $table->dateTime('last_login')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->string('rememberToken')->nullable();
            $table->string('password_reset_code')->nullable();
            $table->string('device_token')->nullable();
           
            $table->string('account_status')->nullable();
            $table->string('fcm_token')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        DB::statement("ALTER TABLE users AUTO_INCREMENT = 14000;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
