<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone')->nullable();
            $table->tinyInteger('gender')->default(0)->comment('性别');
            $table->string('idCardNum')->nullable()->comment('身份证号');
            $table->string('province')->nullable()->comment('省份');
			$table->string('city')->nullable()->comment('城市');
			$table->string('area')->nullable()->comment('区');
			$table->string('address')->nullable()->comment('地址');
            $table->unsignedTinyInteger('status')->default(0)->comment('状态');
            $table->string('idCardFront')->nullable()->comment('身份证正面');
            $table->string('idCardBack')->nullable()->comment('身份证反面');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
