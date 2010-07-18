DELIMITER $$

DROP PROCEDURE IF EXISTS `kaltura_op_mon`.`empty_file_partition`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE kaltura_op_mon.`empty_file_partition`(
	file_type VARCHAR(10),
	partition_number VARCHAR(10)
    )
BEGIN
	CALL drop_file_partition(file_type,partition_number);
	CALL add_file_partition(file_type,partition_number);
    END$$

DELIMITER ;