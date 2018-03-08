<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('category_id')->default(1)->comment('1:新闻，2公告,具体看模型定义');
            $table->string('title')->comment('标题');
            $table->string('keywords')->nullable()->comment('关键词');
            $table->string('description')->nullable()->comment('描述');
            $table->text('content')->comment('内容');
            $table->bigInteger('admin_id')->default(0)->comment('创建者ID');
            $table->string('slug', 64)->nullable()->comment('slug网址连接');
            $table->unsignedTinyInteger('status')->default(1)->comment('状态，1显示，0隐藏');
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
        Schema::dropIfExists('news');
    }
}
