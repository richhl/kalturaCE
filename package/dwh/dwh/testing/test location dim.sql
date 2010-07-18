SELECT *
FROM(
SELECT DISTINCT country,state,city
FROM kaltura.kuser u) a
WHERE city IS NOT NULL AND city <> ''
	AND ('city',city,country,state,city) NOT IN 
	(SELECT location_type_name,location_name,country,state,city FROM kalturadw.dwh_dim_locations l);
SELECT *
FROM(
SELECT DISTINCT country,state
FROM kaltura.kuser u) a
WHERE state IS NOT NULL AND state <> ''
	AND ('state',state,country,state) NOT IN 
	(SELECT location_type_name,location_name,country,state FROM kalturadw.dwh_dim_locations l);

SELECT *
FROM(
SELECT DISTINCT country
FROM kaltura.kuser u) a
WHERE country IS NOT NULL AND country <> ''
	AND ('country',country,country) NOT IN 
	(SELECT location_type_name,location_name,country FROM kalturadw.dwh_dim_locations l);


