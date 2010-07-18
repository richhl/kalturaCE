DELIMITER $$

DROP PROCEDURE IF EXISTS `kaltura_op_mon`.`drop_file_partition`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE kaltura_op_mon.`drop_file_partition`(
	file_type VARCHAR(10),
	partition_number VARCHAR(10)
	)
BEGIN
	DECLARE ds_events_table VARCHAR(100);
	SET ds_events_table = kaltura_op_mon.resolve_event_table_name(file_type,'ds_events_table');

	SET @s = CONCAT('alter table kaltura_op_mon.' , ds_events_table , ' drop PARTITION  p_' , partition_number );
	PREPARE stmt FROM  @s;
	EXECUTE stmt;
	DEALLOCATE PREPARE stmt;
    END$$

DELIMITER ;