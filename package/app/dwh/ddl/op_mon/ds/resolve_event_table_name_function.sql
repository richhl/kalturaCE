DELIMITER $$

DROP FUNCTION IF EXISTS `kaltura_op_mon`.`resolve_event_table_name`$$

CREATE DEFINER=`root`@`%` FUNCTION `kaltura_op_mon`.`resolve_event_table_name`(file_type VARCHAR(100),field_name VARCHAR(100)) 
	RETURNS VARCHAR(100) CHARSET latin1 DETERMINISTIC
BEGIN
	DECLARE ds_events_table VARCHAR(100);
	DECLARE events_table VARCHAR(100);

	IF file_type = 'batch' THEN
		SET ds_events_table = 'dwh_ds_batch_events';
		SET events_table = 'dwh_fact_batch_events';
	ELSEIF file_type = 'api' THEN
		SET ds_events_table = 'dwh_ds_api_events';
		SET events_table = 'dwh_fact_api_events';
	ELSEIF file_type = 'kmc' THEN				# MUST move to the kalturadw & kalturadw_ds schemas
		SET ds_events_table = 'dwh_ds_kmc_events';
		SET events_table = 'dwh_fact_kmc_events';
	ELSE
	
		CALL ERROR_UNKNOWN_AGGR_NAME();
	END IF;
	
	IF field_name = 'ds_events_table' THEN RETURN ds_events_table;
	ELSEIF field_name = 'events_table' THEN RETURN events_table;
	END IF;
	RETURN '';
    END$$

DELIMITER ;