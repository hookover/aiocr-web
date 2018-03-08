<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->unsignedBigInteger('id_a')->comment("主键前半段");
            $table->unsignedBigInteger('id_b')->comment("主键后半段");
            $table->tinyInteger('server_id')->comment('服务器ID，对应server_ids表');
            $table->string('path', 64)->comment('文件相对路径');
            $table->integer('status')->unsigned()->default(0)->comment('识别状态0待处理，1处理中，2识别成功，3识别失败，4超时');
            $table->string('result', 40)->nullable()->comment('识别结果');
            $table->integer('file_type_id')->comment('图片类型ID');
            $table->integer('app_id')->nullable()->comment('软件代码');
            $table->unsignedInteger('user_id')->comment('用户ID');
            $table->unsignedInteger('developer_id')->nullable()->comment('唯一ID');
            $table->integer('cost')->unsigned()->comment('耗费积分');
            $table->bigInteger('ip')->comment('创建时的IP');
            $table->tinyInteger('report')->nullable()->comment('是否已报错：0未，1已报错');
            $table->integer('preparation_a')->nullable()->comment('扩展属性1');
            $table->integer('preparation_b')->nullable()->comment('扩展属性2');
            $table->string('preparation_c')->nullable()->comment('扩展属性3');
            $table->string('preparation_d')->nullable()->comment('扩展属性5');
            $table->string('preparation_e')->nullable()->comment('扩展属性5');
            $table->timestamps();

            $table->primary(['id_a', 'id_b']);


//            $table->foreign('file_type_id')
//                ->references('file_type_id')
//                ->on('image_types')
//                ->onDelete('cascade');
//
//            $table->foreign('soft_id')
//                ->references('soft_id')
//                ->on('softwares')
//                ->onDelete('cascade');
//
//            $table->foreign('user_id')
//                ->references('user_id')
//                ->on('users')
//                ->onDelete('cascade');
//
//            $table->foreign('developer_id')
//                ->references('developer_id')
//                ->on('developers')
//                ->onDelete('cascade');
        });

//        DB::unprepared("alter table files modify id bigint not null AUTO_INCREMENT");

        //自动分区
        if (env('APP_TIMEZONE')) {
            date_default_timezone_set(env('APP_TIMEZONE'));
        }
        $time              = strtotime(date('Y-m-d'));
        $pname             = 'p' . date('Ymd', $time);
        $sub_partition_num = 6; //每天分成几个子分区
        $tmp_sql = [];
        for ($i = 1; $i <= $sub_partition_num; $i++) {
            $sub_pname          = $pname . $i;
            $sub_less_than_time = $time + (86400 / $sub_partition_num) * $i;
            $tmp_sql[]          = "PARTITION {$sub_pname} VALUES LESS THAN ({$sub_less_than_time})";
        }
        DB::unprepared("ALTER TABLE files PARTITION BY RANGE(id_a div 1000) (" . implode(',', $tmp_sql) . ")");

        DB::unprepared("DROP PROCEDURE IF EXISTS AutoPartition");
        DB::unprepared("
            CREATE PROCEDURE AutoPartition()
            BEGIN
              DECLARE v_sysdate date;
              DECLARE v_mindate date;
              DECLARE v_maxdate date;
              DECLARE v_pt varchar(20);
              DECLARE v_maxval varchar(20);
              DECLARE i int;
              DECLARE sub_i int default 1;
              DECLARE sub_max int default {$sub_partition_num};
              DECLARE sub_v_pt varchar(20);
              DECLARE sub_less_than_time int;
              
              /*增加新分区*/
              SELECT FROM_UNIXTIME(max(partition_description)) AS val
              INTO   v_maxdate
              FROM   INFORMATION_SCHEMA.PARTITIONS
              WHERE  TABLE_NAME = 'files';
        
              set v_sysdate = sysdate();
        
              WHILE v_maxdate <= (v_sysdate + INTERVAL 2 DAY) DO
                SET v_pt = date_format(v_maxdate,'%Y%m%d');
                SET v_maxval = date_format(v_maxdate, '%Y-%m-%d');
                
                /*sub_max个子分区*/
                SET sub_i = 1;
                -- select sub_i;
                WHILE (sub_i <= sub_max) DO
               
                    SET sub_less_than_time = UNIX_TIMESTAMP(v_maxdate)  + (86400 DIV sub_max) * sub_i;
                    SET sub_v_pt = concat(v_pt , sub_i);                   
                  
                    SET @sql = concat('alter table files add partition (partition p', sub_v_pt, ' values less than(',sub_less_than_time,'))');
                    -- SELECT @sql;
                    PREPARE stmt FROM @sql;
                    EXECUTE stmt;
                    DEALLOCATE PREPARE stmt;
                    
                    SET sub_i = sub_i + 1;
                END WHILE;
                /*子分区 结束*/
                
                SET v_maxdate = v_maxdate + INTERVAL 1 DAY;
              END WHILE;
        
              /*删除旧分区*/
              SELECT FROM_UNIXTIME(min(partition_description)) AS val
              INTO   v_mindate
              FROM   INFORMATION_SCHEMA.PARTITIONS
              WHERE  TABLE_NAME = 'files';
        
              WHILE v_mindate < (v_sysdate - INTERVAL 3 DAY) DO
                SET v_pt = date_format(v_mindate,'%Y%m%d');
                
                /*sub_max个子分区*/
                SET sub_i = 1;
                -- select sub_i;
                WHILE (sub_i <= sub_max) DO
                
                    SET @sql = concat('alter table files drop partition p', v_pt , sub_i);
                    -- SELECT @sql;
                    PREPARE stmt FROM @sql;
                    EXECUTE stmt;
                    DEALLOCATE PREPARE stmt;
                   
                    SET sub_i = sub_i + 1;
                    
                END WHILE;
                
                SET v_mindate = v_mindate + INTERVAL 1 DAY;
              END WHILE;
            END
        ");

        /*
         * 查询分区信息
         * SELECT * FROM INFORMATION_SCHEMA.PARTITIONS WHERE TABLE_NAME = 'files'
         *
         * 查看files表的全部分区
         * select partition_name,partition_description FROM INFORMATION_SCHEMA.PARTITIONS WHERE TABLE_NAME='files';
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
         * my.cnf的[mysqld]下添加
         * event_scheduler=ON
         *
         * 调用存储过程
         * call AutoPartition
         */

        //自动分区调度器
        //启用自动事件
        DB::unprepared("set global event_scheduler=1");

        //建立事件调度器
        $start_day = date('Y-m-d 04:00:00', $time);
        DB::unprepared("drop event if exists AutoPartitionEvent");
        DB::unprepared("
        create event AutoPartitionEvent
        on schedule every 1 day starts '{$start_day}'
        ON COMPLETION PRESERVE ENABLE
        do
          BEGIN
            call AutoPartition();
          END
        ");
//        DB::unprepared("call AutoPartition");
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
}
