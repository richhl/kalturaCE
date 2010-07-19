DELIMITER $$

DROP PROCEDURE IF EXISTS `kalturadw_ds`.`add_file_partition`$$

CREATE DEFINER=`etl`@`localhost` PROCEDURE kalturadw_ds.`add_file_partition`(
	partition_number VARCHAR(10)
    )
BEGIN
	SET @s = CONCAT('alter table kalturadw_ds.ds_events ADD PARTITION (partition p_' ,
			partition_number ,' values in (', partition_number ,'))');
	PREPARE stmt FROM  @s;
	EXECUTE stmt;
	DEALLOCATE PREPARE stmt;
    END$$

DELIMITER ;