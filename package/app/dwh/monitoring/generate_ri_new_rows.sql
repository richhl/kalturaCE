
SELECT 
	CONCAT('SELECT ''',table_name,''' table_name,',column_name,' new_id FROM kalturadw.',table_name,'
	WHERE ri_ind = 1 AND dwh_update_date > NOW() - INTERVAL 2 DAY limit 10
	UNION ALL')
 FROM COLUMNS WHERE column_key = 'PRI'  AND table_name IN (
	SELECT table_name FROM COLUMNS WHERE column_name = 'ri_ind')
