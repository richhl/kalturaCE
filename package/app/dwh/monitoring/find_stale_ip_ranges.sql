
SELECT 	CONCAT(CASE WHEN MAX(last_update) < NOW() - INTERVAL 45 DAY THEN 'CRIT'
	ELSE 'WARN' END ,
	',The time stamp of the current IP2LOCATION file is: ',last_update) msg
	FROM 
	kalturadw.ip_ranges_last_update 
	HAVING MAX(last_update) < NOW() - INTERVAL 45 DAY
