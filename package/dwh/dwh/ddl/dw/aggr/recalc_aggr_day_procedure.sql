DELIMITER $$

DROP PROCEDURE IF EXISTS `kalturadw`.`recalc_aggr_day`$$

CREATE DEFINER=`etl`@`localhost` PROCEDURE kalturadw.`recalc_aggr_day`(date_val DATE,aggr_name VARCHAR(100))
BEGIN
	DECLARE aggr_table VARCHAR(100);
	DECLARE aggr_id_field VARCHAR(100);

	SET aggr_table = kalturadw.resolve_aggr_name(aggr_name,'aggr_table');
	SET aggr_id_field = kalturadw.resolve_aggr_name(aggr_name,'aggr_id_field');
	
	SET @s = CONCAT('delete from kalturadw.',aggr_table,'
		where date_id = DATE(''',date_val,''')*1');
	PREPARE stmt FROM  @s;
	EXECUTE stmt;
	DEALLOCATE PREPARE stmt;
	SET @s = CONCAT('UPDATE aggr_managment SET is_calculated = 0 
	WHERE aggr_name = ''',aggr_name,''' AND aggr_day = ''',date_val,'''');
	PREPARE stmt FROM  @s;
	EXECUTE stmt;
	DEALLOCATE PREPARE stmt;
	CALL kalturadw.calc_aggr_day(date_val,aggr_name);
    END$$

DELIMITER ;