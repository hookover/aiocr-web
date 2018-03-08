<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeveloperLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('developer_logs', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->unsignedInteger('developer_id')->comment('开发者ID');
            $table->tinyInteger('type')->default(0)->comment('操作类型，0综合,1正常登录，2找回密码，3修改密码');
            $table->string('desc')->nullable()->comment('描述');
            $table->string('browser_info',300)->comment('浏览器');
            $table->bigInteger('ip')->comment('登录IP');
            $table->timestamps();

            $table->foreign('developer_id')
                ->references('developer_id')
                ->on('developers')
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
        Schema::dropIfExists('developer_logs');
    }
}
