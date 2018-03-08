<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apps', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->unsignedInteger('app_id')->unique()->comment('软件ID');
            $table->string('app_key',32)->unique()->comment('软件key,唯一');
            $table->unsignedInteger('developer_id')->comment('开发都ID');
            $table->string('name',64)->comment('软件名称');

            $table->unsignedTinyInteger('status')->default(1)->comment('软件状态，1启用，0不启用');
            $table->integer('developer_id_created')->comment('创建软件人的用户名');
            $table->ipAddress('ip')->comment('创建时的IP');

            $table->integer('preparation_a')->nullable()->comment('扩展属性1');
            $table->integer('preparation_b')->nullable()->comment('扩展属性2');
            $table->string('preparation_c')->nullable()->comment('扩展属性3');
            $table->string('preparation_d')->nullable()->comment('扩展属性5');
            $table->string('preparation_e')->nullable()->comment('扩展属性5');


            $table->softDeletes();
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
        Schema::dropIfExists('apps');
    }
}
