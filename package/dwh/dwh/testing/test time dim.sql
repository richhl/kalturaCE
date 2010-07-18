
SELECT 	day_id, 
	date_field, 
	YEAR, 
	MONTH, 
	day_of_year, 
	day_of_month, 
	day_of_week,
	day_of_week_desc, 
	day_of_week_short_desc, 
	month_desc, 
	month_short_desc, 
	QUARTER	 
FROM kalturadw.dwh_dim_time 
WHERE YEAR(date_field) <> YEAR 
	OR MONTH(date_field) <> MONTH 
	OR DAY(date_field) <> day_of_month
	OR DAYOFYEAR(date_field) <> day_of_year
	OR DAYOFWEEK(date_field) <> day_of_week
	OR MONTHNAME(date_field) COLLATE utf8_general_ci <> month_desc
	OR QUARTER(date_field) <> QUARTER 
	OR (WEEKDAY(date_field)+1)%7+1 <> day_of_week
	OR YEAR(date_field)*10000+MONTH(date_field)*100+DAY(date_field) <> day_id

ORDER BY date_field
LIMIT 100 
