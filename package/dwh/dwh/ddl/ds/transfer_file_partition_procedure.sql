DELIMITER $$

DROP PROCEDURE IF EXISTS `kalturadw_ds`.`transfer_file_partition`$$

CREATE DEFINER=`etl`@`localhost` PROCEDURE `kalturadw_ds`.`transfer_file_partition`(
	partition_number VARCHAR(10)
    )
BEGIN
	SET @s = CONCAT('insert into kalturadw.dwh_fact_events
			 select 
				file_id,event_id,event_type_id,client_version,
			 	event_time, event_date_id, event_hour_id, session_id, partner_id, entry_id,
			 	unique_viewer, widget_id, ui_conf_id, uid, current_point, duration, user_ip,user_ip_number,country_id,location_id,
			 	process_duration, control_id, seek, new_point, domain_id, referrer , entry_media_type_id , entry_partner_id
			 from kalturadw_ds.ds_events 
			 where file_id = ',partition_number,' 
			 ON DUPLICATE KEY UPDATE 
			 kalturadw.dwh_fact_events.file_id = kalturadw.dwh_fact_events.file_id' ); 
	PREPARE stmt FROM  @s;
	EXECUTE stmt;
	DEALLOCATE PREPARE stmt;
    END$$

DELIMITER ;