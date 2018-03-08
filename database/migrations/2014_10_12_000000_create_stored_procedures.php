<?php

use Illuminate\Database\Migrations\Migration;

class CreateStoredProcedures extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->down();
        //根据id_a(bigint类型时间戳)字段创建3个报表
        DB::unprepared("
            CREATE PROCEDURE AutoPartitionByIntTimeStamp(IN v_table_name VARCHAR(32), IN keep_day INT)
            BEGIN
              DECLARE v_sysdate date;
              DECLARE v_mindate date;
              DECLARE v_maxdate date;
              DECLARE v_pt varchar(20);
              DECLARE v_maxval int;
        
              /*增加新分区*/
              set @date_sql = concat('SELECT FROM_UNIXTIME(max(partition_description)) AS val INTO @v_maxdate FROM INFORMATION_SCHEMA.PARTITIONS WHERE  TABLE_NAME = ''', v_table_name , '''');
              PREPARE stmt1 FROM @date_sql;
              EXECUTE stmt1;
              DEALLOCATE PREPARE stmt1 ;
              set v_maxdate = @v_maxdate;
                      
              set v_sysdate = sysdate();
              WHILE v_maxdate <= (v_sysdate + INTERVAL 2 DAY) DO
                SET v_pt = date_format(v_maxdate,'%Y%m%d');
                SET v_maxval = UNIX_TIMESTAMP(v_maxdate) + 86400;

                SET @sql = concat('alter table ', v_table_name , ' add partition (partition p', v_pt, ' values less than(',v_maxval,'))');

                -- SELECT @sql;
                PREPARE stmt FROM @sql;
                EXECUTE stmt;
                DEALLOCATE PREPARE stmt;
                SET v_maxdate = v_maxdate + INTERVAL 1 DAY;
              END WHILE;
        
              /*删除旧分区*/
              SET @date_min_sql = concat('SELECT FROM_UNIXTIME(min(partition_description)) AS val INTO @v_mindate FROM INFORMATION_SCHEMA.PARTITIONS WHERE  TABLE_NAME = ''', v_table_name , '''');
              PREPARE stmt2 FROM @date_min_sql;
              EXECUTE stmt2;
              DEALLOCATE PREPARE stmt2 ;
              set v_mindate = @v_mindate;
              
              set @v_delete_at = (v_sysdate - INTERVAL keep_day DAY);
              WHILE v_mindate <= @v_delete_at DO
                SET v_pt = date_format((v_mindate - INTERVAL 1 DAY),'%Y%m%d');
                SET @_sql = concat('alter table ' , v_table_name , ' drop partition p', v_pt);
                -- SELECT @_sql;
                PREPARE stmt FROM @_sql;
                EXECUTE stmt;
                DEALLOCATE PREPARE stmt;
                SET v_mindate = v_mindate + INTERVAL 1 DAY;
              END WHILE;
            END
        ");

        //定时统计管理员可以看到的全部数据量
        DB::unprepared("DROP PROCEDURE IF EXISTS AutoStaticsticalReportAdmin;");
        DB::unprepared("
        CREATE PROCEDURE AutoStaticsticalReportAdmin(IN minute_ago INT)
            BEGIN
              DECLARE v_minute_ago int;
              DECLARE v_uid int DEFAULT 0;
              DECLARE v_second_ago int;
              DECLARE v_second_one_minute_ago int;

              set v_minute_ago = minute_ago;

              IF (v_minute_ago < 5) THEN
                set v_minute_ago = 5;
              END IF;

              set v_second_ago = UNIX_TIMESTAMP() - (v_minute_ago + 1) * 60;
              set v_second_one_minute_ago = UNIX_TIMESTAMP() - 60;
              /*统计6分钟前~1分钟前的数据*/
              set @sql = concat('SELECT COUNT(*), SUM(cost) into @numbers,@points FROM files WHERE (id_a div 1000) > ', v_second_ago, ' AND (id_a div 1000) < ',v_second_one_minute_ago);

              PREPARE stmt FROM @sql;
              EXECUTE stmt;
              DEALLOCATE PREPARE stmt;

              IF @numbers IS NULL THEN
                set @numbers = 0;
              END IF;
               IF @points IS NULL THEN
                set @points = 0;
              END IF;

              set @in_sql = concat('INSERT INTO statistical_reports_admin(created_at, number, points) VALUES(UNIX_TIMESTAMP(), ', @numbers, ',' , @points, ')');

              PREPARE stmt_1 FROM @in_sql;
              EXECUTE stmt_1;
              DEALLOCATE PREPARE stmt_1;
            END
        ");



        //定时统计前一天开发者和用户的数据量，每天晚上执行
        DB::unprepared("DROP PROCEDURE IF EXISTS AutoStaticsticalReportUserAndDeveloper;");
        /*统计昨天用户和作者的出码量,时间下标记为昨天*/
        DB::unprepared("
        CREATE PROCEDURE AutoStaticsticalReportUserAndDeveloper(IN v_sysdate DATE)
            BEGIN
              DECLARE v_second_start int;
              DECLARE v_second_end int;
--               DECLARE v_sysdate date;
              DECLARE v_total int default 0;
              DECLARE v_done int default false;
              DECLARE v_numbers int default 0;
              DECLARE v_points int default 0;
              DECLARE v_user_id varchar(32) default 0;
              DECLARE v_developer_id int default 0;

              DECLARE user_ids CURSOR FOR (SELECT user_id FROM files WHERE (id_a div 1000) >=  v_second_start AND (id_a div 1000) < v_second_end GROUP BY user_id);
              DECLARE developer_ids CURSOR FOR (SELECT developer_id FROM files WHERE (id_a div 1000) >=  v_second_start AND (id_a div 1000) < v_second_end GROUP BY developer_id);
              DECLARE continue HANDLER FOR not found set v_done = true;

              set v_second_start = UNIX_TIMESTAMP(date_format((v_sysdate - INTERVAL 1 DAY),'%Y%m%d'));
              set v_second_end = UNIX_TIMESTAMP(date_format(v_sysdate, '%Y%m%d'));

              set @v_second_start =v_second_start;
              set @v_second_end =v_second_end;

              -- call AutoStaticsticalReportUserAndDeveloper(1, 19000000)$$
              -- select @user_id,@developer_id,@sql_user_in, @sql_dev_in$$

              open user_ids;
                REPEAT
                  fetch user_ids into v_user_id;
                  BEGIN
                    IF NOT v_done THEN
                      IF v_user_id > 0 THEN
                        set @user_id = v_user_id;
                        set @sql_user = concat('SELECT COUNT(*), SUM(cost) into @numbers,@points FROM files WHERE (id_a div 1000) > ', v_second_start, ' AND (id_a div 1000) < ',v_second_end, ' AND user_id=', v_user_id);
                        PREPARE stmt_user FROM @sql_user;
                        EXECUTE stmt_user;
                        DEALLOCATE PREPARE stmt_user;

                        set @sql_user_in = concat('INSERT INTO statistical_reports_user(created_at, number, points, user_id) VALUES(', v_second_start , ',' , @numbers, ',' , @points, ',', v_user_id ,')');
                        PREPARE stmt_user_in FROM @sql_user_in;
                        EXECUTE stmt_user_in;
                        DEALLOCATE PREPARE stmt_user_in;
                      ELSE
                        set @not_user = true;
                      END IF;
                    END IF;
                  END;

                UNTIL v_done END REPEAT;
              close user_ids;

              set v_done = FALSE;
              open developer_ids;
                REPEAT
                  fetch developer_ids into v_developer_id;
                  BEGIN
                    IF NOT v_done THEN
                      IF v_developer_id > 0 THEN
                        set @developer_id = v_developer_id;

                        set @sql_dev = concat('SELECT COUNT(*), SUM(cost) into @numbers,@points FROM files WHERE (id_a div 1000) > ', v_second_start, ' AND (id_a div 1000) < ',v_second_end, ' AND developer_id=', v_developer_id);
                        PREPARE stmt_dev FROM @sql_dev;
                        EXECUTE stmt_dev;
                        DEALLOCATE PREPARE stmt_dev;

                        set @sql_dev_in = concat('INSERT INTO statistical_reports_developer(created_at, number, points, developer_id) VALUES(', v_second_start ,' , ', @numbers, ',' , @points, ',', v_developer_id ,')');
                        PREPARE stmt_dev_in FROM @sql_dev_in;
                        EXECUTE stmt_dev_in;
                        DEALLOCATE PREPARE stmt_dev_in;
                      ELSE
                        set @not_dev = true;
                      END IF;
                    END IF;
                  END;

                UNTIL v_done END REPEAT;
              close developer_ids;

            END
        ");




        //开启事件
        DB::unprepared("set global event_scheduler=1");
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS AutoPartitionByIntTimeStamp");
        DB::unprepared("DROP PROCEDURE IF EXISTS AutoStaticsticalReportAdmin");
    }
}
