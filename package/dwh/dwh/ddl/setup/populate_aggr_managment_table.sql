SET @from_date='2010-01-01';
SET @to_date='2014-12-31';

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

