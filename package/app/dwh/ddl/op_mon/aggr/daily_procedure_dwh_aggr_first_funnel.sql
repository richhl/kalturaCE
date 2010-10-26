DELIMITER $$

USE `kaltura_op_mon`$$

DROP PROCEDURE IF EXISTS `daily_procedure_dwh_aggr_first_funnel`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `daily_procedure_dwh_aggr_first_funnel`(date_val DATE)
BEGIN
	/* set data from kalturadw.dwh_aggr_partner into dwh_aggr_partner_daily_usage for the new day
	  */
	SET @s = CONCAT('
        INSERT INTO  dwh_aggr_kmc_events_first_funnel
        	(partner_id,kmc_event_id,kmc_event_type_id,kmc_event_time,kmc_event_date_id)
        SELECT a.partner_id,a.kmc_event_id,a.kmc_event_type_id,a.kmc_event_time,a.kmc_event_date_id 
            FROM
            (
            SELECT
            	fact_e.partner_id,fact_e.kmc_event_id,fact_e.kmc_event_type_id,fact_e.kmc_event_time,fact_e.kmc_event_date_id 
            FROM
            	dwh_fact_kmc_events fact_e LEFT JOIN dwh_aggr_kmc_events_first_funnel first_f 
            	ON (fact_e.partner_id=first_f.partner_id AND
            		fact_e.kmc_event_type_id=first_f.kmc_event_type_id AND
            		first_f.partner_id IS NULL)
			WHERE fact_e.kmc_event_date_id=DATE(''',date_val,''')*1            		
            ORDER BY fact_e.kmc_event_time ASC
            ) a
            
            GROUP BY 
            	a.partner_id,a.kmc_event_type_id,a.kmc_event_date_id
        ON DUPLICATE KEY UPDATE
        kmc_event_id=VALUES(kmc_event_id),
        kmc_event_time=VALUES(kmc_event_time);
    	');
	PREPARE stmt FROM  @s;
	EXECUTE stmt;
	DEALLOCATE PREPARE stmt;	

	
	SET @s = CONCAT('
        INSERT INTO dwh_aggr_kmc_events_first_funnel
        	(partner_id,
        	kmc_event_id,
        	kmc_event_type_id,
        	kmc_event_date_id,
        	kmc_prev_event_id,
        	kmc_prev_event_type_id,
        	kmc_prev_event_time,
        	kmc_prev_event_date_id)
        	SELECT
        		a.partner_id,
        		a.kmc_event_id,
        		a.kmc_event_type_id,
        		a.kmc_event_date_id,
        		a.prev_event_id,
        		a.prev_event_type_id,
        		a.prev_event_time,
        		a.prev_event_date_id
        	FROM
        	(	
        	SELECT 
        		fact_e.partner_id,
        		first_f.kmc_event_id,
        		first_f.kmc_event_type_id,
        		first_f.kmc_event_date_id,
        		fact_e.kmc_event_id prev_event_id,
        		fact_e.kmc_event_time prev_event_time,
        		fact_e.kmc_event_type_id prev_event_type_id,
        		fact_e.kmc_event_date_id prev_event_date_id
        	FROM
        		dwh_fact_kmc_events fact_e JOIN dwh_aggr_kmc_events_first_funnel first_f 
        			ON (fact_e.partner_id=first_f.partner_id AND
        				fact_e.kmc_event_time<first_f.kmc_event_time AND 
        				fact_e.kmc_event_type_id<>first_f.kmc_event_type_id)
        	WHERE first_f.kmc_prev_event_id IS NULL
        	ORDER BY fact_e.kmc_event_time DESC
        	) a
        	GROUP BY a.partner_id,a.kmc_event_id
        ON DUPLICATE KEY UPDATE
        	kmc_prev_event_id=VALUES(kmc_prev_event_id),
        	kmc_prev_event_type_id=VALUES(kmc_prev_event_type_id),
        	kmc_prev_event_time=VALUES(kmc_prev_event_time),
        	kmc_prev_event_date_id=VALUES(kmc_prev_event_date_id);	
    	');
	PREPARE stmt FROM  @s;
	EXECUTE stmt;
	DEALLOCATE PREPARE stmt;	

END$$

DELIMITER ;