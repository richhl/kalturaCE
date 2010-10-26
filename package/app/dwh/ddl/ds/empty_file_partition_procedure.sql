DELIMITER $$

DROP PROCEDURE IF EXISTS `kalturadw_ds`.`empty_file_partition` $$
CREATE PROCEDURE  `kalturadw_ds`.`empty_file_partition`(
	partition_number VARCHAR(10)
)
BEGIN
	CALL drop_file_partition(partition_number);
	CALL add_file_partition(partition_number);
END $$

DELIMITER ;