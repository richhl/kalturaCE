SELECT *
FROM kalturadw_ds.files
WHERE  (file_status IN ('WAITING','PROCESSED') AND insert_time < NOW() - INTERVAL 1 DAY)
 OR 
 (file_status = 'RUNNING' AND run_time < NOW() - INTERVAL 1 HOUR)
 OR 
 (file_status = 'TRANSFERING' AND transfer_time < NOW() - INTERVAL 2 HOUR)
 OR 
 (file_status = 'FAILED' AND insert_time > NOW() - INTERVAL 7 DAY)

