DROP PROCEDURE IF EXISTS AutoStaticsticalReportUserAndDeveloper;
/*统计昨天用户和作者的出码量*/
CREATE PROCEDURE AutoStaticsticalReportUserAndDeveloper()
            BEGIN
              DECLARE v_second_start int;
              DECLARE v_second_end int;
              DECLARE v_sysdate date;
              DECLARE v_total int default 0;
              DECLARE v_done int default false;
              DECLARE v_numbers int default 0;
              DECLARE v_points int default 0;
              DECLARE v_user_id varchar(32) default 0;
              DECLARE v_developer_id int default 0;

              DECLARE user_ids CURSOR FOR (SELECT user_id FROM user_ids_view);
              DECLARE developer_ids CURSOR FOR (SELECT developer_id FROM developer_ids_view);
              DECLARE continue HANDLER FOR not found set v_done = true;


              set v_sysdate = sysdate();
              set v_second_start = UNIX_TIMESTAMP(date_format((v_sysdate - INTERVAL 1 DAY),'%Y%m%d'));
              set v_second_end = UNIX_TIMESTAMP(date_format(v_sysdate, '%Y%m%d'));

              set @v_second_start =v_second_start;
              set @v_second_end =v_second_end;

              DROP VIEW IF EXISTS user_ids_view;
              DROP VIEW IF EXISTS developer_ids_view;

              SET @sql_userids = CONCAT("CREATE VIEW user_ids_view AS SELECT user_id FROM files WHERE (id_a div 1000) >=  ", v_second_start, " AND (id_a div 1000) < ", v_second_end , " GROUP BY user_id");
              PREPARE stmt1 FROM @sql_userids;
              EXECUTE stmt1;
              DEALLOCATE PREPARE stmt1;

              SET @sql_developerids = CONCAT("CREATE VIEW developer_ids_view AS SELECT developer_id FROM files WHERE (id_a div 1000) >=  ", v_second_start, " AND (id_a div 1000) < ", v_second_end , " GROUP BY developer_id");
              PREPARE stmt2 FROM @sql_developerids;
              EXECUTE stmt2;
              DEALLOCATE PREPARE stmt2;


              -- call AutoStaticsticalReportUserAndDeveloper()$$
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