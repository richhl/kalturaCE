DELIMITER $$

DROP PROCEDURE IF EXISTS `kalturadw_ds`.`drop_ods_partition` $$
CREATE  PROCEDURE  `kalturadw_ds`.`drop_ods_partition`(
	partition_number VARCHAR(10),
table_name VARCHAR(32)
	)
BEGIN
	SET @s = CONCAT('alter table kalturadw_ds.',table_name,' drop PARTITION  p_' ,
			partition_number );
	PREPARE stmt FROM  @s;
	EXECUTE stmt;
	DEALLOCATE PREPARE stmt;
END $$

DELIMITER ;