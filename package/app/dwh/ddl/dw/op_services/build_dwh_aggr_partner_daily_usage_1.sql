SELECT 
	aggr_p.date_id,
	aggr_p.partner_id,
	aggr_p.aggr_storage aggr_storage_mb,
	FLOOR(aggr_p.aggr_bandwidth/1024) aggr_bandwidth_mb,
	FLOOR(monthly_aggr_p.monthly_bandwidth/1024) aggr_monthly_bandwidth_mb
FROM 
	dwh_aggr_partner aggr_p LEFT JOIN 
(
	SELECT 
		inner_a_p.date_id,
		inner_a_p.partner_id,
		SUM(inner_a_p_2.count_bandwidth) monthly_bandwidth
	FROM  
		dwh_aggr_partner inner_a_p,dwh_aggr_partner  inner_a_p_2
	WHERE
		inner_a_p.partner_id=inner_a_p_2.partner_id
		AND kalturadw.calc_month_id(inner_a_p.date_id)=kalturadw.calc_month_id(inner_a_p_2.date_id)
		AND inner_a_p.date_id>=inner_a_p_2.date_id
	GROUP BY 
		inner_a_p.date_id,
		inner_a_p.partner_id
) monthly_aggr_p
ON (aggr_p.date_id=monthly_aggr_p.date_id AND aggr_p.partner_id=monthly_aggr_p.partner_id)
WHERE
#	aggr_p.date_id < 20090701  AND
	aggr_p.partner_id=300;