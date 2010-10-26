INSERT IGNORE  INTO dwh_aggr_partner_daily_usage (date_id,partner_id,sum_storage_mb,sum_bandwidth_mb)
SELECT 
	aggr_p.date_id,
	aggr_p.partner_id,
	aggr_p.aggr_storage aggr_storage_mb,
	FLOOR(aggr_p.aggr_bandwidth/1024) aggr_bandwidth_mb
FROM 
	dwh_aggr_partner aggr_p ;
	