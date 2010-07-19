SELECT *
FROM kalturadw.dwh_dim_kusers
WHERE created_date_id <>  DATE(created_at)*1
	OR created_hour_id <> HOUR(created_at)
	OR updated_date_id <>  DATE(updated_at)*1
	OR updated_hour_id <> HOUR(updated_at);
	
SELECT *
FROM kalturadw.dwh_dim_partners
WHERE created_date_id <>  DATE(created_at)*1
	OR created_hour_id <> HOUR(created_at)
	OR updated_date_id <>  DATE(updated_at)*1
	OR updated_hour_id <> HOUR(updated_at);
	
SELECT *
FROM kalturadw.dwh_dim_widget
WHERE created_date_id <>  DATE(created_at)*1
	OR created_hour_id <> HOUR(created_at)
	OR updated_date_id <>  DATE(updated_at)*1
	OR updated_hour_id <> HOUR(updated_at);
	
SELECT *
FROM kalturadw.dwh_dim_ui_conf
WHERE created_date_id <>  DATE(created_at)*1
	OR created_hour_id <> HOUR(created_at)
	OR updated_date_id <>  DATE(updated_at)*1
	OR updated_hour_id <> HOUR(updated_at);
	
SELECT *
FROM kalturadw.dwh_dim_entries
WHERE created_date_id <>  DATE(created_at)*1
	OR created_hour_id <> HOUR(created_at)
	OR updated_date_id <>  DATE(updated_at)*1
	OR updated_hour_id <> HOUR(updated_at);
	OR modified_date_id <>  DATE(modified_at)*1
	OR modified_hour_id <> HOUR(modified_at);
	
SELECT *
FROM kalturadw.dwh_fact_partner_activities
WHERE activity_date_id <>  DATE(activity_date)*1
	OR activity_hour_id <> HOUR(activity_date);
	
SELECT *
FROM kalturadw.dwh_fact_events
WHERE event_date_id <>  DATE(event_time)*1
	OR event_hour_id <> HOUR(event_time);
	
