<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWithdrawTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdraws', function (Blueprint $table) {
            $table->increments('id');
            $table->char('uuid', 36)->comment("提现单号");
            $table->unsignedInteger('developer_id')->comment('软件作者ID');
            $table->tinyInteger('channel_id')->comment('提现渠道ID');
            $table->string('real_name',40)->nullable()->comment('真实姓名');
            $table->string('account', 128)->comment('提现的帐户');
            $table->double('money')->comment('提现金额');

            $table->bigInteger('point')->comment('提现点数');
            $table->bigInteger('point_before')->comment('提现前账户点数');
            $table->bigInteger('point_after')->comment('提现后账户点数');

            $table->string('description', 256)->nullable()->comment('描述，备注');

            $table->unsignedInteger('admin_id')->nullable()->comment('处理人 admin id');

            $table->tinyInteger('status')->default(1)->comment('状态:1已创建，2已提现，3已拒绝');

            $table->ipAddress('ip_created')->nullable()->comment('申请提现IP');
            $table->ipAddress('ip_admin')->nullable()->comment('处理管理员IP');


            $table->timestamp('done_at')->nullable()->comment('提现处理完成时间');

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
        Schema::dropIfExists('withdraws');
    }
}
