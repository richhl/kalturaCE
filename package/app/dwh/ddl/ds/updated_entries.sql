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

/*Table structure for table `updated_entries` */

DROP TABLE IF EXISTS `updated_entries`;

CREATE TABLE `updated_entries` (
  `entry_id` varchar(20) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `views` decimal(32,0) DEFAULT NULL,
  `plays` decimal(32,0) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/* Procedure structure for procedure `create_updated_entries` */

/*!50003 DROP PROCEDURE IF EXISTS  `create_updated_entries` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`etl`@`localhost` PROCEDURE `create_updated_entries`(max_date date)
BEGIN
	truncate table kalturadw_ds.updated_entries;
	
	update kalturadw.aggr_managment set start_time = now() where is_calculated = 0 and aggr_day < max_date and aggr_name = 'entry';
	
	insert into kalturadw_ds.updated_entries SELECT entries.entry_id, SUM(count_loads)+ifnull(old_entries.views,0) views, SUM(count_plays)+ifnull(old_entries.plays,0) plays FROM 
	(SELECT entry_id 
		FROM kalturadw.dwh_aggr_events_entry e
		INNER JOIN kalturadw.aggr_managment m ON (e.date_id = m.aggr_day_int)
		WHERE is_calculated = 0 
		  and m.aggr_day < max_date
		  AND m.aggr_name = 'entry') entries
	INNER JOIN
	kalturadw.dwh_aggr_events_entry
	ON (dwh_aggr_events_entry.entry_id = entries.entry_id)
	left outer join
	kalturadw.entry_plays_views_before_08_2009 as old_entries
	on (entries.entry_id = old_entries.entry_id)
	GROUP BY entries.entry_id;
    END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
