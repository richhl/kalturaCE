DELIMITER $$

DROP PROCEDURE IF EXISTS `kalturadw`.`calc_aggr_day`$$

CREATE DEFINER=`etl`@`localhost` PROCEDURE kalturadw.`calc_aggr_day`(date_val DATE,aggr_name VARCHAR(100))
BEGIN
	DECLARE aggr_table VARCHAR(100);
	DECLARE aggr_id_field VARCHAR(100);
	DECLARE aggr_id_field_str VARCHAR(100);
	DECLARE extra VARCHAR(100);

	SET aggr_table = kalturadw.resolve_aggr_name(aggr_name,'aggr_table');
	SET aggr_id_field = kalturadw.resolve_aggr_name(aggr_name,'aggr_id_field');

	IF ( aggr_id_field <> "" ) THEN
		SET aggr_id_field_str = CONCAT (',',aggr_id_field);
	ELSE
		SET aggr_id_field_str = "";
	END IF;
	
	SET @s = CONCAT('UPDATE aggr_managment SET start_time = NOW()
	WHERE aggr_name = ''',aggr_name,''' AND aggr_day = ''',date_val,'''');
	PREPARE stmt FROM  @s;
	EXECUTE stmt;
	DEALLOCATE PREPARE stmt;
	# there is an explicit list of all the fields because in some cases the aggr_table can have plenty more fields
	SET @s = CONCAT('INSERT INTO kalturadw.',aggr_table,'
		(partner_id
		,date_id 
		',aggr_id_field_str,' 
		,sum_time_viewed 
		,count_time_viewed 
		,count_plays 
		,count_loads 
		,count_plays_25 
		,count_plays_50 
		,count_plays_75 
		,count_plays_100 
		,count_edit
		,count_viral 
		,count_download 
		,count_report
  		,count_buf_start
  		,count_buf_end) 
	SELECT  partner_id,date_id',aggr_id_field_str,',
	SUM(time_viewed) sum_time_viewed,
	COUNT(time_viewed) count_time_viewed,
	SUM(count_plays) count_plays,
	SUM(count_loads) count_loads,
	SUM(count_plays_25) count_plays_25,
	SUM(count_plays_50) count_plays_50,
	SUM(count_plays_75) count_plays_75,
	SUM(count_plays_100) count_plays_100,
	SUM(count_edit) count_edit,
	SUM(count_viral) count_viral,
	SUM(count_download) count_download,
	SUM(count_report) count_report,
	SUM(count_buf_start) count_buf_start,
	SUM(count_buf_end) count_buf_end
	FROM (
		SELECT partner_id,DATE(event_time)*1 date_id',aggr_id_field_str,',session_id,
			MAX(IF(event_type_id IN(4,5,6,7),current_point,NULL))/60000  time_viewed,
			COUNT(IF(event_type_id = 2, 1,NULL)) count_loads,
			COUNT(IF(event_type_id = 3, 1,NULL)) count_plays,
			COUNT(IF(event_type_id = 4, 1,NULL)) count_plays_25,
			COUNT(IF(event_type_id = 5, 1,NULL)) count_plays_50,
			COUNT(IF(event_type_id = 6, 1,NULL)) count_plays_75,
			COUNT(IF(event_type_id = 7, 1,NULL)) count_plays_100,
			COUNT(IF(event_type_id = 8, 1,NULL)) count_edit ,
			COUNT(IF(event_type_id = 9, 1,NULL)) count_viral ,
			COUNT(IF(event_type_id = 10, 1,NULL)) count_download ,
			COUNT(IF(event_type_id = 11, 1,NULL)) count_report,
			COUNT(IF(event_type_id = 12, 1,NULL)) count_buf_start ,
			COUNT(IF(event_type_id = 13, 1,NULL)) count_buf_end		
		FROM kalturadw.dwh_fact_events  ev 
		WHERE event_type_id IN (2,3,4,5,6,7,8,9,10,11,12,13) /*event types %*/
			AND event_date_id = DATE(''',date_val,''')*1
			AND entry_media_type_id IN (1,5,6)  /* allow only video & audio & mix */
		GROUP BY partner_id,DATE(event_time)*1',aggr_id_field_str,',session_id,ev.uid
	) AS a
	GROUP BY partner_id,date_id',aggr_id_field_str,';');
	PREPARE stmt FROM  @s;
	EXECUTE stmt;
	DEALLOCATE PREPARE stmt;

# if a specific aggregation should run some extra procedures - the must be one called 'daily_procedure_' + the table name

	SET extra = CONCAT('daily_procedure_',aggr_table);
	IF EXISTS (SELECT * FROM INFORMATION_SCHEMA.ROUTINES WHERE ROUTINE_NAME=extra) THEN
		# dynamically call the daily procedure for the aggr_table
		SET @ss = CONCAT('CALL ',extra,'(''', date_val,''',''',aggr_name,''');'); 
		PREPARE stmt1 FROM  @ss;
		EXECUTE stmt1;
		DEALLOCATE PREPARE stmt1;
	END IF ;

	SET @s = CONCAT('UPDATE aggr_managment SET is_calculated = 1,end_time = NOW()
	WHERE aggr_name = ''',aggr_name,''' AND aggr_day = ''',date_val,'''');
	PREPARE stmt FROM  @s;
	EXECUTE stmt;
	DEALLOCATE PREPARE stmt;
    END$$

DELIMITER ;