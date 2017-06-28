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
            $table->increments('id')->comment('ID');
            $table->string('name')->comment('用户名');
            $table->string('password', 64)->comment('密码');
            $table->string('tel', 16)->unique();
            $table->string('token')->nullable();
            $table->integer('create_time')->unsigned()->comment('创建时间');
            $table->integer('update_time')->unsigned()->comment('修改时间');
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
