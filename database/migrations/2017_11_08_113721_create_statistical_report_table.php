<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatisticalReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statistical_reports_user', function (Blueprint $table) {
            $table->integer('user_id')->comment('用户ID');
            $table->unsignedBigInteger('created_at')->comment('记示录时间');
            $table->integer('number')->comment('数量');
            $table->bigInteger('points')->comment('积分');
            $table->primary(['user_id', 'created_at']);
        });
        Schema::create('statistical_reports_developer', function (Blueprint $table) {
            $table->integer('developer_id')->comment('开发者ID');
            $table->unsignedBigInteger('created_at')->comment('记示录时间');
            $table->integer('number')->comment('数量');
            $table->bigInteger('points')->comment('积分');
            $table->bigInteger('dividend')->nullable()->comment('分成积分');
            $table->primary(['developer_id', 'created_at']);
        });
        //管理员统计所有人产生的识别日志
        Schema::create('statistical_reports_admin', function (Blueprint $table) {
            $table->unsignedBigInteger('created_at')->comment('记示录时间');
            $table->integer('number')->comment('数量');
            $table->bigInteger('points')->comment('积分');
            $table->primary(['created_at']);
        });


        if (env('APP_TIMEZONE')) {
            date_default_timezone_set(env('APP_TIMEZONE'));
        }
        $time           = strtotime(date('Y-m-d'));
        $pname          = 'p' . date('Ymd', $time);
        $less_than_time = $time + 86400;

        DB::unprepared("ALTER TABLE statistical_reports_user PARTITION BY RANGE(created_at) (PARTITION {$pname} VALUES LESS THAN ({$less_than_time}))");
        DB::unprepared("ALTER TABLE statistical_reports_developer PARTITION BY RANGE(created_at) (PARTITION {$pname} VALUES LESS THAN ({$less_than_time}))");
        DB::unprepared("ALTER TABLE statistical_reports_admin PARTITION BY RANGE(created_at) (PARTITION {$pname} VALUES LESS THAN ({$less_than_time}))");

        /*
         * 查询分区信息
         * SELECT * FROM INFORMATION_SCHEMA.PARTITIONS WHERE TABLE_NAME = 'statistical_reports_user'
         *
         * 查看files表的全部分区
         * select partition_name,partition_description FROM INFORMATION_SCHEMA.PARTITIONS WHERE TABLE_NAME='statistical_reports_user';
         *
         * 查看事件
         * show events\G;
         * SELECT * FROM mysql.event;
         * SELECT * FROM information_schema.events;
         *
         * 查看事件是否开启
         * show variables like '%event_scheduler';
         * 设置
         * set global event_scheduler=1;
         *
         * 调用存储过程
         * call AutoPartition
         *
         * 事件查看
         * show events\G;
         *
         * 查看存储过程
         * show procedure status\G;
         * show PROCEDURE status where db='aiocr'\G;
         */

        //自动分区调度器


        //建立事件调度器
        //建立自动分区表
        $start_day = date('Y-m-d 02:00:00', $time);
        DB::unprepared("drop event if exists AutoPartitionForStatisticalReportsEvent");
        DB::unprepared("
        create event AutoPartitionForStatisticalReportsEvent
        on schedule every 1 day starts '{$start_day}'
        ON COMPLETION PRESERVE ENABLE
        do
          BEGIN
            call AutoPartitionByIntTimeStamp('statistical_reports_user', 180);
            call AutoPartitionByIntTimeStamp('statistical_reports_developer', 180);
            call AutoPartitionByIntTimeStamp('statistical_reports_admin', 60);
          END
        ");
        DB::unprepared("call AutoPartitionByIntTimeStamp('statistical_reports_user', 180)");
        DB::unprepared("call AutoPartitionByIntTimeStamp('statistical_reports_developer', 180)");
        DB::unprepared("call AutoPartitionByIntTimeStamp('statistical_reports_admin', 60)");


        //每天5点统计前一天开发者和用户产生的数据并入库到对应报表
        $start_day = date('Y-m-d 05:00:00');
        DB::unprepared("drop event if exists AutoStaticsticalReportUserAndDeveloperEvent");
        DB::unprepared("
        create event AutoStaticsticalReportUserAndDeveloperEvent
        on schedule every 1 MINUTE starts '{$start_day}'
        ON COMPLETION PRESERVE ENABLE
        do
          BEGIN
            DECLARE v_sysdate date;
            set v_sysdate = sysdate();
            call AutoStaticsticalReportUserAndDeveloper(v_sysdate);
          END
        ");
        DB::unprepared("call AutoStaticsticalReportUserAndDeveloper('{$start_day}')");


        //每10分钟统计一次前6分钟～前5分钟的数据并入库到管理员的统计报表
        $start_day = date('Y-m-d H:00:00');
        DB::unprepared("drop event if exists AutoStaticsticalReportAdminEvent");
        DB::unprepared("
        create event AutoStaticsticalReportAdminEvent
        on schedule every 5 MINUTE starts '{$start_day}'
        ON COMPLETION PRESERVE ENABLE
        do
          BEGIN
            call AutoStaticsticalReportAdmin(5);
          END
        ");
        DB::unprepared("call AutoStaticsticalReportAdmin(5)");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statistical_reports_user');
        Schema::dropIfExists('statistical_reports_developer');
        Schema::dropIfExists('statistical_reports_admin');
    }
}
