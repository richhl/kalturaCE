 SELECT ip.*,c.country,c.country_id
FROM kalturadw.dwh_dim_ip_ranges ip,dwh_dim_locations c
WHERE ip.country_short = c.country
	AND ip.country_id <> c.country_id
	AND c.location_type_name = 'country'
	AND ip_from % 10000 = 0
LIMIT 10