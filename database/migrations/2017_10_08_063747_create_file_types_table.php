<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_types', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('file_type_id')->unique()->comment('唯一ID');
            $table->integer('cost')->unsigned()->comment('单次价格');
            $table->integer('length')->default(0)->unsigned()->comment('验证码长度，0不限制');
            $table->string('name',40)->comment('名称');
            $table->string('description',128)->nullable()->comment('描述');
            $table->tinyInteger('ai_enable')->default(1)->unsigned()->comment('1启用自动识别,0不启用，默认启用');
            $table->boolean('status')->default(1)->comment('状态，1正常，0封禁');

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
        Schema::dropIfExists('file_types');
    }
}
