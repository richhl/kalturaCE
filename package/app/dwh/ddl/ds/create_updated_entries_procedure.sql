
DELIMITER $$
USE `kalturadw_ds`$$
DROP procedure IF EXISTS `create_updated_entries`$$
USE `kalturadw_ds`$$
CREATE DEFINER=`etl`@`localhost` PROCEDURE `create_updated_entries`(max_date date)
BEGIN
	truncate table kalturadw_ds.updated_entries;
	
	update kalturadw.aggr_managment set start_time = now() where is_calculated = 0 and aggr_day < max_date and aggr_name = 'plays_views';
	
	insert into kalturadw_ds.updated_entries SELECT entries.entry_id, SUM(count_loads)+ifnull(old_entries.views,0) views, SUM(count_plays)+ifnull(old_entries.plays,0) plays FROM 
	(SELECT entry_id 
		FROM kalturadw.dwh_aggr_events_entry e
		INNER JOIN kalturadw.aggr_managment m ON (e.date_id = m.aggr_day_int)
		WHERE is_calculated = 0 
		  and m.aggr_day < max_date
		  AND m.aggr_name = 'plays_views') entries
	INNER JOIN
	kalturadw.dwh_aggr_events_entry
	ON (dwh_aggr_events_entry.entry_id = entries.entry_id)
	left outer join
	kalturadw.entry_plays_views_before_08_2009 as old_entries
	on (entries.entry_id = old_entries.entry_id)
	GROUP BY entries.entry_id;
    END;
$$
DELIMITER ;
