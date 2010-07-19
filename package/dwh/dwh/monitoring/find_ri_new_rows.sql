SELECT a.table_name,a.new_id
FROM(
SELECT 'dwh_dim_entries' table_name,entry_id new_id FROM kalturadw.dwh_dim_entries
WHERE ri_ind = 1 AND dwh_update_date > NOW() - INTERVAL 2 DAY limit 10
UNION ALL
SELECT 'dwh_dim_kusers' table_name,kuser_id new_id FROM kalturadw.dwh_dim_kusers
WHERE ri_ind = 1 AND dwh_update_date > NOW() - INTERVAL 2 DAY limit 10
UNION ALL
SELECT 'dwh_dim_partners' table_name,partner_id new_id FROM kalturadw.dwh_dim_partners
WHERE ri_ind = 1 AND dwh_update_date > NOW() - INTERVAL 2 DAY limit 10
UNION ALL
SELECT 'dwh_dim_ui_conf' table_name,ui_conf_id new_id FROM kalturadw.dwh_dim_ui_conf
WHERE ri_ind = 1 AND dwh_update_date > NOW() - INTERVAL 2 DAY limit 10
UNION ALL
SELECT 'dwh_dim_widget' table_name,widget_id new_id FROM kalturadw.dwh_dim_widget
WHERE ri_ind = 1 AND dwh_update_date > NOW() - INTERVAL 2 DAY limit 10
UNION ALL
SELECT 'dwh_fact_partner_activities' table_name,partner_activity_id new_id FROM kalturadw.dwh_fact_partner_activities
WHERE ri_ind = 1 AND dwh_update_date > NOW() - INTERVAL 2 DAY limit 10
) a