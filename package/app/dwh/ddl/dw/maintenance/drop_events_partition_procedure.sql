DELIMITER $$

DROP PROCEDURE IF EXISTS `kalturadw`.`drop_events_partition`$$

CREATE DEFINER=`etl`@`localhost` PROCEDURE kalturadw.`drop_events_partition`(month_interval INT)
BEGIN
	DECLARE p_name VARCHAR(100);
	main:LOOP
		SELECT MIN(partition_name) n
		INTO p_name
		FROM `information_schema`.`partitions` 
		WHERE `partitions`.`TABLE_NAME` = 'dwh_fact_events'
			AND FROM_DAYS(partition_description) < NOW() - INTERVAL month_interval MONTH;
		IF p_name IS NULL THEN LEAVE main; END IF;
		SET @s = CONCAT('alter table kalturadw.dwh_fact_events drop PARTITION ',p_name);
		PREPARE stmt FROM  @s;
		EXECUTE stmt;
		DEALLOCATE PREPARE stmt;
	END LOOP main;	
	main2:LOOP
		SELECT MIN(partition_name) n
		INTO p_name
		FROM `information_schema`.`partitions` 
		WHERE `partitions`.`TABLE_NAME` = 'dwh_aggr_events_entry'
			AND partition_description < DATE(NOW() - INTERVAL month_interval MONTH)*1;
		IF p_name IS NULL THEN LEAVE main2; END IF;
		SET @s = CONCAT('alter table kalturadw.dwh_aggr_events_entry drop PARTITION ',p_name);
		PREPARE stmt FROM  @s;
		EXECUTE stmt;
		DEALLOCATE PREPARE stmt;
	END LOOP main2;	
    END$$

DELIMITER ;