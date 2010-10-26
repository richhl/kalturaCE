mysql  < db_create.sql

mysql  < etl_log.sql
mysql  < last_job_run_view.sql
mysql  < "bi sources"/bisources_control.sql
mysql  < "bi sources"/bisources_EDITOR_TYPE.sql
mysql  < "bi sources"/bisources_ENTRY_MEDIA_SOURCE.sql
mysql  < "bi sources"/bisources_ENTRY_MEDIA_TYPE.sql
mysql  < "bi sources"/bisources_ENTRY_STATUS.sql
mysql  < "bi sources"/bisources_ENTRY_TYPE.sql
mysql  < "bi sources"/bisources_event_type.sql
mysql  < "bi sources"/bisources_gender.sql
mysql  < "bi sources"/bisources_MODERATION_STATUS.sql
mysql  < "bi sources"/bisources_PARTNER_ACTIVITY.sql
mysql  < "bi sources"/bisources_partner_status.sql
mysql  < "bi sources"/bisources_PARTNER_SUB_ACTIVITY.sql
mysql  < "bi sources"/bisources_partner_type.sql
mysql  < "bi sources"/bisources_UI_CONF_STATUS.sql
mysql  < "bi sources"/bisources_UI_CONF_TYPE.sql
mysql  < "bi sources"/bisources_user_status.sql
mysql  < "bi sources"/bisources_WIDGET_SECURITY_POLICY.sql
mysql  < "bi sources"/bisources_WIDGET_SECURITY_TYPE.sql
# 	mysql  < "bi sources"/set_bisources_to_uppercase.sql


mysql  < dw/bi_sources.sql
mysql  < dw/dw_control.sql
mysql  < dw/dw_EDITOR_TYPE.sql
mysql  < dw/dw_ENTRY_MEDIA_SOURCE.sql
mysql  < dw/dw_ENTRY_MEDIA_TYPE.sql
mysql  < dw/dw_ENTRY_STATUS.sql
mysql  < dw/dw_ENTRY_TYPE.sql
mysql  < dw/dw_event_type.sql
mysql  < dw/dw_gender.sql
mysql  < dw/dw_MODERATION_STATUS.sql
mysql  < dw/dw_PARTNER_ACTIVITY.sql
mysql  < dw/dw_partner_status.sql
mysql  < dw/dw_PARTNER_SUB_ACTIVITY.sql
mysql  < dw/dw_partner_type.sql
mysql  < dw/dw_UI_CONF_STATUS.sql
mysql  < dw/dw_UI_CONF_TYPE.sql
mysql  < dw/dw_user_status.sql
mysql  < dw/dw_WIDGET_SECURITY_POLICY.sql
mysql  < dw/dw_widget_security_type.sql
mysql  < dw/entries.sql
mysql  < dw/events.sql
mysql  < dw/ip_ranges.sql
mysql  < dw/kuser.sql
mysql  < dw/ui_conf.sql
mysql  < dw/widget.sql
mysql  < dw/locations.sql
mysql  < dw/locations_init.sql
mysql  < dw/countries_view.sql
mysql  < dw/partner.sql
mysql  < dw/Partner_Activities.sql
mysql  < dw/ri/ri_defaults.sql
mysql  < dw/ri/ri_defaults_grouped_view.sql
mysql  < dw/ri/ri_mapping.sql
mysql  < dw/ri/ri_mapping_and_defaults_view.sql
mysql  < dw/events/add_events_partition_porcedure.sql
mysql  < dw/events/drop_events_partition_procedure.sql
mysql  < dw/events/dwh_fact_events_partitions_view.sql

mysql  < dw/aggr/aggr_events_country.sql
mysql  < dw/aggr/aggr_events_domain.sql
mysql  < dw/aggr/aggr_events_entry.sql
mysql  < dw/aggr/aggr_managment.sql
mysql  < dw/aggr/calc_aggr_day_procedure.sql
mysql  < dw/aggr/dwh_aggr_events_partitions_view.sql
mysql  < dw/aggr/recalc_aggr_day_procedure.sql
mysql  < dw/aggr/resolve_aggr_name_function.sql

mysql  < ds/events.sql
mysql  < ds/files.sql
mysql  < ds/add_file_partition_procedure.sql
mysql  < ds/drop_file_partition_pocedure.sql
mysql  < ds/ds_events_partitions_view.sql
mysql  < ds/empty_file_partition_procedure.sql
mysql  < ds/get_ip_country_function.sql
mysql  < ds/restore_file_status_procedure.sql
mysql  < ds/set_file_status_procedure.sql
mysql  < ds/set_file_status_full_procedure.sql
mysql  < ds/transfer_file_partition_procedure.sql