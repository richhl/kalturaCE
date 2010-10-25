SELECT
	all_time.day_id,
	dim_p.partner_id,
	aggr_p_daily.date_id,
	aggr_p_daily.partner_id
FROM 
	( dwh_dim_time all_time 
		LEFT JOIN 
		dwh_dim_partners dim_p ON ( all_time.day_id BETWEEN 20090630 AND  20091215 AND all_time.day_id>=dim_p.created_date_id ) 
	) 
		LEFT JOIN
		dwh_aggr_partner_daily_usage aggr_p_daily ON ( 
			dim_p.partner_id=aggr_p_daily.partner_id AND all_time.day_id=aggr_p_daily.date_id 

			)
WHERE
	aggr_p_daily.date_id IS NULL AND 
	dim_p.partner_id<1300;
	