DELIMITER $$

DROP PROCEDURE IF EXISTS `kaltura_op_mon`.`add_events_partition`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE kaltura_op_mon.`add_events_partition`()
BEGIN
	DECLARE p_name,p_value VARCHAR(100);

	SELECT EXTRACT( YEAR_MONTH FROM MAX(partition_description)) n,
	       (MAX(partition_description) + INTERVAL 1 MONTH)*1  v
	INTO p_name,p_value
	FROM `information_schema`.`partitions` 
	WHERE `partitions`.`TABLE_NAME` = 'dwh_fact_batch_events';
	SET @s = CONCAT('alter table kaltura_op_mon.dwh_fact_batch_events ADD PARTITION (partition p_' ,p_name ,' values less than (', p_value ,'))');
	PREPARE stmt FROM  @s;
	EXECUTE stmt;
	DEALLOCATE PREPARE stmt;
END$$

DELIMITER ;