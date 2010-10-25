SET @from_date='2009-07-01';
SET @to_date='2009-12-31';

INSERT INTO kalturadw.aggr_managment
SELECT 'entry' tn,DATE(date_field) d,0 i,NULL ts,NULL  te
FROM kalturadw.dwh_dim_time
WHERE date_field BETWEEN @from_date AND @to_date;

INSERT INTO kalturadw.aggr_managment
SELECT 'country' tn,DATE(date_field) d,0 i,NULL ts,NULL  te
FROM kalturadw.dwh_dim_time
WHERE date_field BETWEEN @from_date AND @to_date;

INSERT INTO kalturadw.aggr_managment
SELECT 'domain' tn,DATE(date_field) d,0 i,NULL ts,NULL  te
FROM kalturadw.dwh_dim_time
WHERE date_field BETWEEN @from_date AND @to_date;

INSERT INTO kalturadw.aggr_managment
SELECT 'partner' tn,DATE(date_field) d,0 i,NULL ts,NULL  te
FROM kalturadw.dwh_dim_time
WHERE date_field BETWEEN @from_date AND @to_date and date_field not in (select aggr_day from kalturadw.aggr_managment where aggr_name="partner" );

INSERT INTO kalturadw.aggr_managment
SELECT 'widget' tn,DATE(date_field) d,0 i,NULL ts,NULL  te
FROM kalturadw.dwh_dim_time
WHERE date_field BETWEEN @from_date AND @to_date;
 

INSERT INTO 	kalturadw.aggr_managment
	(aggr_name,aggr_day,is_calculated)
SELECT
	aggr_name_t.* aggr_name,
	DATE(all_time.date_field) aggr_day,
	0 is_calculated
FROM
(
	SELECT "entry" UNION SELECT "country" UNION SELECT  "domain" UNION SELECT  "partner" UNION SELECT "widget" 
) aggr_name_t,
	dwh_dim_time all_time
WHERE
all_time.day_id BETWEEN 20100101 AND 20100601;
