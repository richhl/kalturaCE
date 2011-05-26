DELIMITER $$

DROP FUNCTION IF EXISTS `kalturadw`.`calc_prev_date_id`$$

CREATE DEFINER=`etl`@`localhost` FUNCTION `kalturadw`.`calc_prev_date_id`(date_id INT(11)) 
	RETURNS INT DETERMINISTIC
BEGIN
	set @d=STR_TO_DATE(CONCAT("",date_id),"%Y%m%d");
	RETURN DATE(ADDDATE(@d, INTERVAL -1 DAY))*1;
    END$$

DELIMITER ;
