DELIMITER $$

DROP PROCEDURE IF EXISTS `kalturadw_ds`.`add_file_partition` $$
CREATE PROCEDURE  `kalturadw_ds`.`add_file_partition`(
	partition_number VARCHAR(10)
)
BEGIN
CALL kalturadw_ds.add_ods_partition(partition_number,'ds_events');
END $$

DELIMITER ;