<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentGiftTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_gifts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedDecimal('condition_money')->unique()->comment('充值达到多少钱');
            $table->unsignedDecimal('gift_money')->comment('送多少钱');
            $table->tinyInteger('status')->default(1)->comment('状态：1,启用，2禁用');
            $table->tinyInteger('type')->default(1)->comment('类型：1用户充值，2开发者充值，3两者充值');
            $table->timestamp('expiration')->nullable()->comment('过期时间,默认 null为不过期，有时间表示到达该时间后则充值赠送失效');
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
        Schema::dropIfExists('payment_gifts');
    }
}
