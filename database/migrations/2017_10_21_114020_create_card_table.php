<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('developer_id')->comment('生成卡的作者');
            $table->unsignedInteger('user_id')->nullable()->comment('使用用户ID');
            $table->Integer('point_before')->nullable()->comment('使用充值卡前账户余额');
            $table->Integer('point_after')->nullable()->comment('使用充值卡后账户余额');

            $table->char('card', 58)->unique()->comment('卡密');
            $table->unsignedInteger('point')->comment('面值点数');
            $table->double('money')->comment('面值RMB');

            $table->ipAddress('ip_used')->nullable()->comment('使用IP');
            $table->ipAddress('ip_created')->nullable()->comment('创建IP');

            $table->tinyInteger('status')->default(1)->comment('状态:1可用，2已用，3已废');
            $table->timestamp('time_used')->nullable()->comment('使用时间');
            $table->timestamps();

            $table->foreign('developer_id')
                ->references('developer_id')
                ->on('developers')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('user_id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cards');
    }
}
