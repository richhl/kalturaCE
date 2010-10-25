DELIMITER $$

DROP PROCEDURE IF EXISTS `kalturadw_ds`.`empty_ods_partition` $$
CREATE PROCEDURE  `kalturadw_ds`.`empty_ods_partition`(
	partition_number VARCHAR(10),
table_name VARCHAR(32)
)
BEGIN
	CALL drop_ods_partition(partition_number,table_name);
	CALL add_ods_partition(partition_number,table_name);
END $$

DELIMITER ;