DELIMITER $$

DROP PROCEDURE IF EXISTS `kalturadw_ds`.`transfer_file_partition` $$
CREATE PROCEDURE  `kalturadw_ds`.`transfer_file_partition`(
	partition_number VARCHAR(10)
)
BEGIN
	CALL transfer_ods_partition(1,partition_number);
END $$
DELIMITER ;