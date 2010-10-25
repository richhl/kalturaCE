DELIMITER $$

USE `kalturadw`$$

DROP PROCEDURE IF EXISTS `daily_procedure_dwh_aggr_events_widget`$$

CREATE DEFINER=`etl`@`localhost` PROCEDURE `daily_procedure_dwh_aggr_events_widget`(date_val DATE,aggr_name VARCHAR(100))
BEGIN
	DECLARE aggr_table VARCHAR(100);
	DECLARE aggr_id_field VARCHAR(100);
	DECLARE aggr_id_field_str VARCHAR(100);


	SET aggr_table = kalturadw.resolve_aggr_name(aggr_name,'aggr_table');
	SET aggr_id_field = kalturadw.resolve_aggr_name(aggr_name,'aggr_id_field');
	
	IF ( aggr_id_field <> "" ) THEN
		SET aggr_id_field_str = CONCAT (',',aggr_id_field);
	ELSE
		SET aggr_id_field_str = "";
	END IF;

	/*	 set data from kalturadw.dwh_dim_entries */ 
	SET @s = CONCAT('
    	INSERT INTO kalturadw.',aggr_table,'
    		(partner_id, 
    		date_id, 
			widget_id,
     		count_widget_loads)
    	SELECT  
    		partner_id,event_date_id,widget_id,
    		SUM(IF(event_type_id=1,1,NULL)) count_widget_loads
		FROM kalturadw.dwh_fact_events  ev
		WHERE event_type_id IN (1) /*event types %*/
			AND event_date_id = DATE(''',date_val,''')*1
		GROUP BY partner_id,DATE(event_time)*1',aggr_id_field_str,'
    	ON DUPLICATE KEY UPDATE
    		count_widget_loads=VALUES(count_widget_loads);
    	');
	PREPARE stmt FROM  @s;
	EXECUTE stmt;
	DEALLOCATE PREPARE stmt;
END$$

DELIMITER ;