<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDevelopersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('developers', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->unsignedInteger('developer_id')->unique()->comment('唯一ID');
            $table->string('email',64)->unique()->comment('用户邮箱必填');
            $table->string('username',32)->unique()->nullable()->comment('用户名');
            $table->string('phone',20)->unique()->nullable()->comment('用户手机号');
            $table->string('password',64)->comment('密码');
            $table->string('salt',32)->comment('盐');
            $table->string('real_name',40)->nullable()->comment('真实姓名');
            $table->string('qq',20)->nullable()->comment('开发商QQ');
            $table->string('alipay',64)->nullable()->comment('开发商支付宝');
            $table->string('tenpay',64)->nullable()->comment('开发商微信支付');
            $table->bigInteger('point_pay_total')->default(0)->comment('充值点数');
            $table->bigInteger('point_pay_current')->default(0)->comment('剩余点数');
            $table->bigInteger('point_dividend_total')->default(0)->comment('累计分成点数');
            $table->bigInteger('point_dividend_current')->default(0)->comment('当前分成点数');
            $table->bigInteger('vip_point')->default(0)->comment('vip积分');

            $table->unsignedTinyInteger('status_account')->default(1)->comment('帐户状态，1正常，0封禁');

            $table->boolean('locked_ip')->default(0)->comment('IP锁定，0不锁定，1锁定在IP段内登录');
            $table->bigInteger('locked_address_start')->nullable()->comment('锁定地区开始ip,ip2long');
            $table->bigInteger('locked_address_end')->nullable()->comment('锁定地区结束ip,ip2long');

            $table->integer('count_login')->default(0)->unsigned()->comment('用户累计登录次数');
            $table->bigInteger('ip_register')->comment('用户注册IP');
            $table->bigInteger('ip_pre_login')->nullable()->comment('上次登录IP');
            $table->bigInteger('ip_last_login')->nullable()->comment('用户最后登录IP，即当前IP');

            $table->timestamp('time_pre_login')->nullable()->comment('用户上次登录时间');
            $table->timestamp('time_last_login')->nullable()->comment('用户最后登录时间，即当前登陆时间');

            $table->integer('preparation_a')->nullable()->comment('扩展属性1');
            $table->integer('preparation_b')->nullable()->comment('扩展属性2');
            $table->string('preparation_c')->nullable()->comment('扩展属性3');
            $table->string('preparation_d')->nullable()->comment('扩展属性5');
            $table->string('preparation_e')->nullable()->comment('扩展属性5');

            $table->char('api_token',64)->unique()->comment('API验证token');
            $table->timestamp('api_token_created_at')->nullable()->comment('API验证token创建时间');

            $table->rememberToken();

            $table->softDeletes();
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
        Schema::drop('developers');
    }
}
