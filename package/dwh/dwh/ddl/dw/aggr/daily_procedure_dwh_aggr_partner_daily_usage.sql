DELIMITER $$

USE `kalturadw`$$

DROP PROCEDURE IF EXISTS `daily_procedure_dwh_aggr_partner_daily_usage`$$

CREATE DEFINER=`etl`@`localhost` PROCEDURE `daily_procedure_dwh_aggr_partner_daily_usage`(date_val DATE)
BEGIN
	/* set data from kalturadw.dwh_aggr_partner into dwh_aggr_partner_daily_usage for the new day
	  */
	SET @s = CONCAT('
    	INSERT INTO kalturadw.dwh_aggr_partner_daily_usage
    		(partner_id, 
    		date_id, 
    		sum_storage_mb   , /* MB */
    		sum_bandwidth_mb   /* MB */
    		)
		SELECT 
			a.partner_id,
			a.date_id,
			a.aggr_storage,
			floor(a.aggr_bandwidth/1024)
		FROM dwh_aggr_partner a 
		WHERE 
			a.date_id=DATE(''',date_val,''')*1
		ON DUPLICATE KEY UPDATE
			sum_storage_mb=VALUES(sum_storage_mb),
			sum_bandwidth_mb=VALUES(sum_bandwidth_mb);
    	');
	PREPARE stmt FROM  @s;
	EXECUTE stmt;
	DEALLOCATE PREPARE stmt;	

#	set @rc_1= select row_count();
	
	/* now complete the missing data for all those partners that existed in the previous day were not added for the new day */
	SET @prev_date_id=kalturadw.calc_prev_date_id(DATE(date_val)*1);
	SET @s = CONCAT('
        INSERT IGNORE INTO dwh_aggr_partner_daily_usage
        (partner_id,date_id,sum_storage_mb)
        SELECT 
        	l_aggr_p_d.partner_id,
        	DATE(''',date_val,''')*1,
        	l_aggr_p_d.sum_storage_mb
        FROM 
        	dwh_aggr_partner_daily_usage l_aggr_p_d  
        WHERE
        	l_aggr_p_d.sum_storage_mb IS NOT NULL AND 
        	l_aggr_p_d.date_id=',@prev_date_id,' AND 
        	l_aggr_p_d.partner_id NOT IN 
        	(
        		SELECT r_aggr_p_d.partner_id
        		FROM dwh_aggr_partner_daily_usage r_aggr_p_d 
        		WHERE r_aggr_p_d.date_id=DATE(''',date_val,''')*1
        	);
    	');
	PREPARE stmt FROM  @s;
	EXECUTE stmt;
	DEALLOCATE PREPARE stmt;	
	
#	set @rc_2= select row_count();

	/* set monthly bandwidth from kalturadw.dwh_aggr_partner into dwh_aggr_partner_daily_usage for the new day
	  */
	SET @s = CONCAT('
    	INSERT INTO kalturadw.dwh_aggr_partner_daily_usage
    		(partner_id, 
    		date_id, 
    		sum_monthly_bandwidth_mb   /* MB */
    		)
		SELECT 
			a.partner_id,
			a.date_id,
			FLOOR(SUM(b.count_bandwidth)/1024) sum_monthly_bandwidth_mb
		FROM dwh_aggr_partner a ,dwh_aggr_partner b
		WHERE 
			a.partner_id=b.partner_id AND
			a.date_id=DATE(''',date_val,''')*1 AND
			a.date_id>=b.date_id AND
			kalturadw.calc_month_id(b.date_id)=kalturadw.calc_month_id(a.date_id)
		GROUP BY 
			b.partner_id	
		/* added to fix a bug in MySQL < 5.1.39 for insert .. select out of same (empty) partition */
		UNION  SELECT -1,DATE(''',date_val,''')*1,-1
		ON DUPLICATE KEY UPDATE
			sum_monthly_bandwidth_mb=VALUES(sum_monthly_bandwidth_mb);
    	');
	PREPARE stmt FROM  @s;
	EXECUTE stmt;
	DEALLOCATE PREPARE stmt;	


	/* set monthly calculated storage
	  */
	SET @s = CONCAT('
   		INSERT INTO kalturadw.dwh_aggr_partner_daily_usage
    		(partner_id, 
    		date_id, 
    		calculated_monthly_storage_mb   /* MB */
    		)
		SELECT 
			du.partner_id partner_id,
			DATE(''',date_val,''')*1,
			SUM(du.sum_storage_mb)/DAY(LAST_DAY(DATE(du.date_id))) calc_monthly_storage_mb
		FROM 
			dwh_aggr_partner_daily_usage du
		WHERE
			kalturadw.calc_month_id(du.date_id) = kalturadw.calc_month_id(DATE(''',date_val,''')*1)
			AND du.date_id<=DATE(''',date_val,''')*1
		GROUP BY 
			du.partner_id
		/* added to fix a bug in MySQL < 5.1.39 for insert .. select out of same (empty) partition */
		UNION  SELECT -1,DATE(''',date_val,''')*1,-1
		ON DUPLICATE KEY UPDATE
			calculated_monthly_storage_mb=VALUES(calculated_monthly_storage_mb);
    	');
	PREPARE stmt FROM  @s;
	EXECUTE stmt;
	DEALLOCATE PREPARE stmt;	

	/* set calculated storage
	  */
	SET @s = CONCAT('
   		INSERT INTO kalturadw.dwh_aggr_partner_daily_usage
    		(partner_id, 
    		date_id, 
    		calculated_storage_mb   /* MB */
    		)
		SELECT 
			du.partner_id partner_id,
			DATE(''',date_val,''')*1,
			SUM(du.sum_storage_mb)/DAY(LAST_DAY(DATE(du.date_id))) calc_storage_mb
		FROM 
			dwh_aggr_partner_daily_usage du
		WHERE
			du.date_id<=DATE(''',date_val,''')*1
		GROUP BY 
			du.partner_id
		/* added to fix a bug in MySQL < 5.1.39 for insert .. select out of same (empty) partition */
		UNION  SELECT -1,DATE(''',date_val,''')*1,-1
		ON DUPLICATE KEY UPDATE
			calculated_storage_mb=VALUES(calculated_storage_mb);
    	');
	PREPARE stmt FROM  @s;
	EXECUTE stmt;
	DEALLOCATE PREPARE stmt;	

#	select @rc_1,@rc_2;	
END$$

DELIMITER ;


DELIMITER $$

USE `kalturadw`$$

DROP PROCEDURE IF EXISTS `daily_procedure_dwh_aggr_partner_daily_usage_loop`$$

CREATE DEFINER=`etl`@`localhost` PROCEDURE `daily_procedure_dwh_aggr_partner_daily_usage_loop`(from_date DATE,to_date DATE)
BEGIN
DECLARE _count INT DEFAULT 0;

DECLARE _current_date DATE;

    increment: LOOP
		SET _current_date = ADDDATE(from_date, INTERVAL _count DAY); 
		IF _current_date > to_date THEN
			LEAVE increment;
		END IF;
		SET _count = _count + 1;

		CALL kalturadw.daily_procedure_dwh_aggr_partner_daily_usage(_current_date);
    END LOOP increment;
    SELECT _count;

END$$

DELIMITER ;
