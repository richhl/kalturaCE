DELIMITER $$

DROP PROCEDURE IF EXISTS `kaltura_op_mon`.`batch_transfer_file_partition`$$

/*
 *	Will transfer all the records from the ds_XXX_events table into the XX_evetns table based on the partition_number
 *  
 */
CREATE DEFINER=`root`@`localhost` PROCEDURE `kaltura_op_mon`.`batch_transfer_file_partition`(
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
			,batch_event_id	
			,batch_client_version
			,batch_event_type_id
			,batch_name	
			,batch_event_time
			,batch_event_date_id
			,batch_event_hour_id
			,batch_session_id
			,batch_type
			,host_name
			,location_id
			,section_id
			,batch_id
			,partner_id
			,entry_id
			,bulk_upload_id
			,batch_paranet_id
			,batch_root_id
			,batch_status
			,batch_progress
			,value_1
			,value_2
		from kaltura_op_mon.' , ds_events_table , ' ds_events ' ,  
		'where file_id = ' , partition_number,' 
		ON DUPLICATE KEY UPDATE 
			file_id = ds_events.file_id' ); 
	PREPARE stmt FROM  @s;
	EXECUTE stmt;
	DEALLOCATE PREPARE stmt;
    END$$

DELIMITER ;