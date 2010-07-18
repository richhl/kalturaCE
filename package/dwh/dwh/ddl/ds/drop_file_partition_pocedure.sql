DELIMITER $$

DROP PROCEDURE IF EXISTS `kalturadw_ds`.`drop_file_partition`$$

CREATE DEFINER=`etl`@`localhost` PROCEDURE kalturadw_ds.`drop_file_partition`(
	partition_number VARCHAR(10)
	)
BEGIN
	SET @s = CONCAT('alter table kalturadw_ds.ds_events drop PARTITION  p_' ,
			partition_number );
	PREPARE stmt FROM  @s;
	EXECUTE stmt;
	DEALLOCATE PREPARE stmt;
    END$$

DELIMITER ;