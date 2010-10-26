DELIMITER $$

USE `kalturadw_ds`$$

DROP PROCEDURE IF EXISTS `monitor`$$

CREATE DEFINER=`etl`@`localhost` PROCEDURE `monitor`()

BEGIN
	CREATE TEMPORARY TABLE statement_results
		<<STMT>>
	;
	INSERT INTO kalturalog.monitor_status(source,date,had_errors) select source, date, had_errors from (select '<<filename>>' source,curdate() date,count(*)>0 had_errors from statement_results) a on duplicate key update had_errors = a.had_errors; 
	SELECT * FROM statement_results;
	DROP TABLE statement_results;
    END$$

CALL monitor();$$

DELIMITER ;
