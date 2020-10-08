<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

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
            $table->bigIncrements('id');
            $table->string('nickname', 50)->comment('昵称');
            $table->string('portrait')->comment('头像');
            $table->string('mobile', 11)->default(0)->unique()->comment('手机号');
            $table->smallInteger('vip_num')->comment('vip等级');
            $table->string('province', 50)->nullable()->comment('省');
            $table->string('city', 50)->nullable()->comment('市');
            $table->string('area', 50)->nullable()->comment('区');
            $table->string('address')->nullable()->comment('详细地址');
            $table->rememberToken();
            $table->timestamps();
        });

        DB::statement(" ALTER TABLE users comment '用户表' ");
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
