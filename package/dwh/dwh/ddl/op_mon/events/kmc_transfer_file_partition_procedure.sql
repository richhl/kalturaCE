DELIMITER $$

DROP PROCEDURE IF EXISTS `kaltura_op_mon`.`kmc_transfer_file_partition`$$

/*
 *	Will transfer all the records from the ds_XXX_events table into the XX_evetns table based on the partition_number
 *  
 */
CREATE DEFINER=`root`@`localhost` PROCEDURE `kaltura_op_mon`.`kmc_transfer_file_partition`(
	file_type VARCHAR(10),
	partition_number VARCHAR(10)
    )
BEGIN
	DECLARE ds_events_table VARCHAR(100);
	DECLARE events_table VARCHAR(100);

	SET ds_events_table = kaltura_op_mon.resolve_event_table_name(file_type,'ds_events_table');
	SET events_table = kaltura_op_mon.resolve_event_table_name(file_type,'events_table');
	
	SET @s = CONCAT('insert into kaltura_op_mon.' , events_table , 
		' select 
	  file_id 
	,kmc_event_id
	,kmc_client_version 	
	,kmc_event_type_id
	,kmc_event_time 
	,kmc_event_date_id
	,kmc_event_hour_id
	,kmc_event_session_id  
	,kmc_event_action_path 
	,kmc_event_client_timestamp 
	,kmc_event_ks 
	,partner_id 
	,uid 
	,entry_id 
	,ui_conf_id 
	,widget_id 
	,flavor_id 
	,user_ip 
	,ip_long 
	,error_code 
	,error 	
		from kaltura_op_mon.' , ds_events_table , ' ds_events ' ,  
		'where file_id = ' , partition_number,' 
		ON DUPLICATE KEY UPDATE 
			file_id = ds_events.file_id' ); 
	PREPARE stmt FROM  @s;
	EXECUTE stmt;
	DEALLOCATE PREPARE stmt;
    END$$

DELIMITER ;