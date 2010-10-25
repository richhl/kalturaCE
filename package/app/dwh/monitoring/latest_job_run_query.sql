SET @job := '',@num :=1;
SELECT jobname,`status`,HAD_ERRORS,LAST_RUN_START,LAST_RUN_END
	,LINES_INPUT,LINES_OUTPUT,LINES_UPDATED,LOG_FIELD
FROM
(

SELECT `l1`.`JOBNAME` AS `JOBNAME`,`l1`.`STATUS` AS `status`,`l1`.`ERRORS` AS `HAD_ERRORS`,
		`l1`.`DEPDATE` AS `LAST_RUN_START`,`l1`.`LOGDATE` AS `LAST_RUN_END`,
		`l1`.`LINES_INPUT` AS `LINES_INPUT`,`l1`.`LINES_OUTPUT` AS `LINES_OUTPUT`,
		`l1`.`LINES_UPDATED` AS `LINES_UPDATED`,
		`l1`.`LOG_FIELD` AS `LOG_FIELD` 
	,@num := IF(@job = l1.jobname, @num + 1, 1) AS row_number,
   @job := l1.jobname AS dummy
FROM kalturalog.etl_log l1
ORDER BY logdate DESC
) a
WHERE row_number = 1
      
      
     