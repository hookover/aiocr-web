<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('admin_id')->unique()->comment('管理员ID');
            $table->string('username', 32)->nullable()->comment('用户名');
            $table->string('email', 64)->unique();
            $table->string('password', 64);

            $table->boolean('status_account')->default(1)->comment('帐户状态，1启用，0封禁');

            $table->integer('count_login')->default(0)->unsigned()->comment('用户累计登录次数');
            $table->ipAddress('ip_register')->comment('用户注册IP');
            $table->ipAddress('ip_pre_login')->nullable()->comment('上次登录IP');
            $table->ipAddress('ip_last_login')->nullable()->comment('用户最后登录IP，即当前IP');

            $table->timestamp('time_pre_login')->nullable()->comment('用户上次登录时间');
            $table->timestamp('time_last_login')->nullable()->comment('用户最后登录时间，即当前登陆时间');


            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
