SELECT a.table_name,a.last_update,TIMEDIFF(NOW(),last_update) time_since_last_update
FROM(
SELECT 'dwh_dim_entries' table_name,MAX(dwh_update_date) last_update FROM kalturadw.dwh_dim_entries
UNION ALL
SELECT 'dwh_dim_kusers' table_name,MAX(dwh_update_date) last_update FROM kalturadw.dwh_dim_kusers
UNION ALL
SELECT 'dwh_dim_partners' table_name,MAX(dwh_update_date) last_update FROM kalturadw.dwh_dim_partners
UNION ALL
SELECT 'dwh_dim_ui_conf' table_name,MAX(dwh_update_date) last_update FROM kalturadw.dwh_dim_ui_conf
UNION ALL
SELECT 'dwh_dim_widget' table_name,MAX(dwh_update_date) last_update FROM kalturadw.dwh_dim_widget
UNION ALL
SELECT 'dwh_fact_partner_activities' table_name,MAX(dwh_update_date) last_update FROM kalturadw.dwh_fact_partner_activities
) a
WHERE a.last_update < NOW() - INTERVAL 2 DAY