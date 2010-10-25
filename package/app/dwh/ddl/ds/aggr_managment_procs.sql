/*
SQLyog Community v8.3 
MySQL - 5.1.41-3ubuntu12.3 : Database - kalturadw_ds
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
USE `kalturadw_ds`;

/* Procedure structure for procedure `mark_as_aggregated` */

/*!50003 DROP PROCEDURE IF EXISTS  `mark_as_aggregated` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`etl`@`localhost` PROCEDURE `mark_as_aggregated`( max_date VARCHAR(4000), aggr_name VARCHAR(50))
BEGIN
	SET @s = CONCAT('update kalturadw.aggr_managment set is_calculated=1, end_time=now() ',
			'where aggr_day < ''',max_date,''' ',
            'and is_calculated = 0 ',            
			'and (aggr_name = ''',aggr_name,''' or ''all''=''',aggr_name,''');');
	PREPARE stmt FROM @s;
	EXECUTE stmt;
	DEALLOCATE PREPARE stmt;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `mark_for_reaggregation` */

/*!50003 DROP PROCEDURE IF EXISTS  `mark_for_reaggregation` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`etl`@`localhost` PROCEDURE `mark_for_reaggregation`( date_id_list varchar(4000), aggr_name varchar(50))
BEGIN
	SET @smark4reagg  = CONCAT('update kalturadw.aggr_managment set is_calculated=0,start_time=null,end_time=null ',
			'where aggr_day_int in (',date_id_list,') ',
			'and (aggr_name = ''',aggr_name,''' or ''all''=''',aggr_name,''');');
	PREPARE stmtmark FROM @smark4reagg ;
	EXECUTE stmtmark;
	DEALLOCATE PREPARE stmtmark;
    END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
