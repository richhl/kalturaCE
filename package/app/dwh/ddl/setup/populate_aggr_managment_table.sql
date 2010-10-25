SET @from_date='2010-01-01';
SET @to_date='2014-12-31';

INSERT INTO kalturadw.aggr_managment (aggr_name,aggr_day_int,aggr_day,is_calculated,start_time,end_time)
SELECT 'entry' tn,DATE_FORMAT(DATE(date_field), '%Y%m%d'),DATE(date_field) d,0 i,NULL ts,NULL  te
FROM kalturadw.dwh_dim_time
WHERE date_field BETWEEN @from_date AND @to_date;

INSERT INTO kalturadw.aggr_managment (aggr_name,aggr_day_int,aggr_day,is_calculated,start_time,end_time)
SELECT 'country' tn,DATE_FORMAT(DATE(date_field), '%Y%m%d'),DATE(date_field) d,0 i,NULL ts,NULL  te
FROM kalturadw.dwh_dim_time
WHERE date_field BETWEEN @from_date AND @to_date;

INSERT INTO kalturadw.aggr_managment (aggr_name,aggr_day_int,aggr_day,is_calculated,start_time,end_time)
SELECT 'domain' tn,DATE_FORMAT(DATE(date_field), '%Y%m%d'),DATE(date_field) d,0 i,NULL ts,NULL  te
FROM kalturadw.dwh_dim_time
WHERE date_field BETWEEN @from_date AND @to_date;

INSERT INTO kalturadw.aggr_managment (aggr_name,aggr_day_int,aggr_day,is_calculated,start_time,end_time)
SELECT 'partner' tn,DATE_FORMAT(DATE(date_field), '%Y%m%d'),DATE(date_field) d,0 i,NULL ts,NULL  te
FROM kalturadw.dwh_dim_time
WHERE date_field BETWEEN @from_date AND @to_date AND date_field NOT IN (SELECT aggr_day FROM kalturadw.aggr_managment WHERE aggr_name="partner" );

INSERT INTO kalturadw.aggr_managment (aggr_name,aggr_day_int,aggr_day,is_calculated,start_time,end_time)
SELECT 'widget' tn,DATE_FORMAT(DATE(date_field), '%Y%m%d'),DATE(date_field) d,0 i,NULL ts,NULL  te
FROM kalturadw.dwh_dim_time
WHERE date_field BETWEEN @from_date AND @to_date;

INSERT INTO kalturadw.aggr_managment (aggr_name,aggr_day_int,aggr_day,is_calculated,start_time,end_time)
SELECT 'fms_sessions' tn,DATE_FORMAT(DATE(date_field), '%Y%m%d'),DATE(date_field) d,0 i,NULL ts,NULL  te
FROM kalturadw.dwh_dim_time
WHERE date_field BETWEEN @from_date AND @to_date;

INSERT INTO kalturadw.aggr_managment (aggr_name,aggr_day_int,aggr_day,is_calculated,start_time,end_time)
SELECT 'plays_views' tn,DATE_FORMAT(DATE(date_field), '%Y%m%d'),DATE(date_field) d,0 i,NULL ts,NULL  te
FROM kalturadw.dwh_dim_time
WHERE date_field BETWEEN @from_date AND @to_date;


INSERT INTO kalturadw.aggr_managment (aggr_name,aggr_day_int,aggr_day,is_calculated,start_time,end_time)
SELECT 'uid' tn,DATE_FORMAT(DATE(date_field), '%Y%m%d'),DATE(date_field) d,0 i,NULL ts,NULL  te
FROM kalturadw.dwh_dim_time
WHERE date_field BETWEEN @from_date AND @to_date;