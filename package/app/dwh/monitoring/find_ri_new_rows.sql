SELECT 'dwh_dim_control' table_name,control_id new_id FROM kalturadw.dwh_dim_control
	WHERE ri_ind = 1 AND dwh_update_date > NOW() - INTERVAL 10 DAY LIMIT 10
	UNION ALL
SELECT 'dwh_dim_domain' table_name,domain_id new_id FROM kalturadw.dwh_dim_domain
	WHERE ri_ind = 1 AND dwh_update_date > NOW() - INTERVAL 10 DAY LIMIT 10
	UNION ALL
SELECT 'dwh_dim_editor_type' table_name,editor_type_id new_id FROM kalturadw.dwh_dim_editor_type
	WHERE ri_ind = 1 AND dwh_update_date > NOW() - INTERVAL 10 DAY LIMIT 10
	UNION ALL
SELECT 'dwh_dim_entry_media_source' table_name,entry_media_source_id new_id FROM kalturadw.dwh_dim_entry_media_source
	WHERE ri_ind = 1 AND dwh_update_date > NOW() - INTERVAL 10 DAY LIMIT 10
	UNION ALL
SELECT 'dwh_dim_entry_media_type' table_name,entry_media_type_id new_id FROM kalturadw.dwh_dim_entry_media_type
	WHERE ri_ind = 1 AND dwh_update_date > NOW() - INTERVAL 10 DAY LIMIT 10
	UNION ALL
SELECT 'dwh_dim_entry_status' table_name,entry_status_id new_id FROM kalturadw.dwh_dim_entry_status
	WHERE ri_ind = 1 AND dwh_update_date > NOW() - INTERVAL 10 DAY LIMIT 10
	UNION ALL
SELECT 'dwh_dim_entry_type' table_name,entry_type_id new_id FROM kalturadw.dwh_dim_entry_type
	WHERE ri_ind = 1 AND dwh_update_date > NOW() - INTERVAL 10 DAY LIMIT 10
	UNION ALL
SELECT 'dwh_dim_event_type' table_name,event_type_id new_id FROM kalturadw.dwh_dim_event_type
	WHERE ri_ind = 1 AND dwh_update_date > NOW() - INTERVAL 10 DAY LIMIT 10
	UNION ALL
SELECT 'dwh_dim_gender' table_name,gender_id new_id FROM kalturadw.dwh_dim_gender
	WHERE ri_ind = 1 AND dwh_update_date > NOW() - INTERVAL 10 DAY LIMIT 10
	UNION ALL
SELECT 'dwh_dim_kusers' table_name,kuser_id new_id FROM kalturadw.dwh_dim_kusers
	WHERE ri_ind = 1 AND dwh_update_date > NOW() - INTERVAL 10 DAY LIMIT 10
	UNION ALL
SELECT 'dwh_dim_locations' table_name,location_id new_id FROM kalturadw.dwh_dim_locations
	WHERE ri_ind = 1 AND dwh_update_date > NOW() - INTERVAL 10 DAY LIMIT 10
	UNION ALL
SELECT 'dwh_dim_moderation_status' table_name,moderation_status_id new_id FROM kalturadw.dwh_dim_moderation_status
	WHERE ri_ind = 1 AND dwh_update_date > NOW() - INTERVAL 10 DAY LIMIT 10
	UNION ALL
SELECT 'dwh_dim_partner_activity' table_name,partner_activity_id new_id FROM kalturadw.dwh_dim_partner_activity
	WHERE ri_ind = 1 AND dwh_update_date > NOW() - INTERVAL 10 DAY LIMIT 10
	UNION ALL
SELECT 'dwh_dim_partner_group_type' table_name,partner_group_type_id new_id FROM kalturadw.dwh_dim_partner_group_type
	WHERE ri_ind = 1 AND dwh_update_date > NOW() - INTERVAL 10 DAY LIMIT 10
	UNION ALL
SELECT 'dwh_dim_partner_status' table_name,partner_status_id new_id FROM kalturadw.dwh_dim_partner_status
	WHERE ri_ind = 1 AND dwh_update_date > NOW() - INTERVAL 10 DAY LIMIT 10
	UNION ALL
SELECT 'dwh_dim_partner_sub_activity' table_name,partner_sub_activity_id new_id FROM kalturadw.dwh_dim_partner_sub_activity
	WHERE ri_ind = 1 AND dwh_update_date > NOW() - INTERVAL 10 DAY LIMIT 10
	UNION ALL
SELECT 'dwh_dim_partner_type' table_name,partner_type_id new_id FROM kalturadw.dwh_dim_partner_type
	WHERE ri_ind = 1 AND dwh_update_date > NOW() - INTERVAL 10 DAY LIMIT 10
	UNION ALL
SELECT 'dwh_dim_partners' table_name,partner_id new_id FROM kalturadw.dwh_dim_partners
	WHERE ri_ind = 1 AND dwh_update_date > NOW() - INTERVAL 10 DAY LIMIT 10
	UNION ALL
SELECT 'dwh_dim_ui_conf' table_name,ui_conf_id new_id FROM kalturadw.dwh_dim_ui_conf
	WHERE ri_ind = 1 AND dwh_update_date > NOW() - INTERVAL 10 DAY LIMIT 10
	UNION ALL
SELECT 'dwh_dim_ui_conf_status' table_name,ui_conf_status_id new_id FROM kalturadw.dwh_dim_ui_conf_status
	WHERE ri_ind = 1 AND dwh_update_date > NOW() - INTERVAL 10 DAY LIMIT 10
	UNION ALL
SELECT 'dwh_dim_ui_conf_type' table_name,ui_conf_type_id new_id FROM kalturadw.dwh_dim_ui_conf_type
	WHERE ri_ind = 1 AND dwh_update_date > NOW() - INTERVAL 10 DAY LIMIT 10
	UNION ALL
SELECT 'dwh_dim_user_status' table_name,user_status_id new_id FROM kalturadw.dwh_dim_user_status
	WHERE ri_ind = 1 AND dwh_update_date > NOW() - INTERVAL 10 DAY LIMIT 10
	UNION ALL
SELECT 'dwh_dim_widget' table_name,widget_id new_id FROM kalturadw.dwh_dim_widget
	WHERE ri_ind = 1 AND dwh_update_date > NOW() - INTERVAL 10 DAY LIMIT 10
	UNION ALL
SELECT 'dwh_dim_widget_security_policy' table_name,widget_security_policy_id new_id FROM kalturadw.dwh_dim_widget_security_policy
	WHERE ri_ind = 1 AND dwh_update_date > NOW() - INTERVAL 10 DAY LIMIT 10
	UNION ALL
SELECT 'dwh_dim_widget_security_type' table_name,widget_security_type_id new_id FROM kalturadw.dwh_dim_widget_security_type
	WHERE ri_ind = 1 AND dwh_update_date > NOW() - INTERVAL 10 DAY LIMIT 10
	UNION ALL
SELECT 'dwh_dim_entries' table_name,entry_id new_id FROM kalturadw.dwh_dim_entries
	WHERE ri_ind = 1 AND dwh_update_date > NOW() - INTERVAL 10 DAY LIMIT 10 
	