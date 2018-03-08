<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->char('payment_id',26)->unique()->comment('平台充值单号,唯一UUID');

            $table->tinyInteger('pay_channel_id')->unsigned()->default(0)->comment('充值通道:0,管理员手工，1充值卡，2支付宝，3腾讯支付，4微信支付，5网银转账，6平台优惠活动赠送');
            $table->string('trade_no',64)->nullable()->index()->comment('第三方支付平台/银行转账的订单号/充值卡号');

            $table->tinyInteger('user_type')->comment('用户类型，1为用户，2为开发商');
            $table->unsignedInteger('uid')->index()->comment('充值的用户/开发者ID');

            $table->double('money')->comment('充值金额');
            $table->double('actual_money')->default(0)->comment('实际充值金额');

            $table->bigInteger('point')->comment('充值点数');
            $table->bigInteger('point_before')->default(0)->comment('充值前账户点数');
            $table->bigInteger('point_after')->default(0)->comment('充值后账户点数');

            $table->string('description',256)->nullable()->comment('描述，当为线下管理员充值时要用到');
            $table->integer('admin_id')->default(0)->unsigned()->comment('处理人ID 线下转账时，需要记录操作管理员的ID，若为系统充值，设置为0');

            $table->tinyInteger('status')->default(1)->unsigned()->comment('处理状态 1 创建充值订单（未支付） 2 充值成功 3 充值失败');
            $table->ipAddress('ip')->comment('创建充值单时,用户的ip地址');

            $table->timestamp('done_at')->nullable()->comment('完成时间');

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
        Schema::dropIfExists('payments');
    }
}
