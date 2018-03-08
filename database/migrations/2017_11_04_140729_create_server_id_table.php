<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServerIdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('server_ids', function (Blueprint $table) {
            $table->increments('id')->comment('ID');
            $table->unsignedTinyInteger('server_id')->unique()->comment('服务器ID,范围10～99,对应API中env里的配置');
            $table->unsignedTinyInteger('server_type')->default(1)->comment('服务器类型，1通用型，2登录服务器，3上传服务器，4获取结果服务器，5报错服务器');
            $table->string('server_img_url', 128)->comment('图片URL前缀，如http://img.a.com');
            $table->string('server_api_url', 128)->comment('api接口地址，如http://api.a.com');
            $table->unsignedTinyInteger('server_api_weight')->default(100)->comment('权重，最小1,最大100');
            $table->unsignedTinyInteger('status')->default(1)->comment('状态：1启用，0停用，暂定，具体见模型里定义');
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
        Schema::dropIfExists('server_ids');
    }
}
