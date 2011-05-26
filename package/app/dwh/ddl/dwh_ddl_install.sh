#!/bin/bash
USER="etl"
PW="etl"
KITCHEN=/usr/local/pentaho/pdi
ROOT_DIR=/opt/kaltura/dwh
HOST=localhost
PORT=3306

while getopts "u:p:k:d:h:P:" o
do	case "$o" in
	u)	USER="$OPTARG";;
	p)	PW="$OPTARG";;
    k)	KITCHEN="$OPTARG";;
    d)	ROOT_DIR="$OPTARG";;
	h)	HOST="$OPTARG";;
	P)	PORT="$OPTARG";;
	[?])	echo >&2 "Usage: $0 [-u username] [-p password] [-k  pdi-path] [-d dwh-path] [-h host-name] [-P port]"
		exit 1;;
	esac
done

function mysqlexec {
        echo "now executing $1"
        mysql -u$USER -p$PW -h$HOST -P$PORT < $1 >>  $SQL_LOG

		ret_val=$?
        if [ $ret_val -ne 0 ];then
			echo $ret_val
			echo "Error - bailing out!"
			exit
        fi
}

ETL_ROOT_DIR=$ROOT_DIR/etlsource/

SQL_ROOT_DIR=$ROOT_DIR/ddl/
BISOURCE_ROOT_DIR=$SQL_ROOT_DIR/bi_sources/
DS_ROOT_DIR=$SQL_ROOT_DIR/ds/
DW_ROOT_DIR=$SQL_ROOT_DIR/dw/
SETUP_ROOT_DIR=$SQL_ROOT_DIR/setup/

SQL_LOG=$SQL_ROOT_DIR/installation_log

#general
mysqlexec $SQL_ROOT_DIR/db_create.sql

#bisource
mysqlexec $BISOURCE_ROOT_DIR/bisources_EDITOR_TYPE.sql
mysqlexec $BISOURCE_ROOT_DIR/bisources_ENTRY_MEDIA_SOURCE.sql 
mysqlexec $BISOURCE_ROOT_DIR/bisources_ENTRY_MEDIA_TYPE.sql 
mysqlexec $BISOURCE_ROOT_DIR/bisources_ENTRY_STATUS.sql 
mysqlexec $BISOURCE_ROOT_DIR/bisources_ENTRY_TYPE.sql 
mysqlexec $BISOURCE_ROOT_DIR/bisources_FLAVOR_ASSET_STATUS.sql 
mysqlexec $BISOURCE_ROOT_DIR/bisources_MODERATION_STATUS.sql
mysqlexec $BISOURCE_ROOT_DIR/bisources_PARTNER_ACTIVITY.sql
mysqlexec $BISOURCE_ROOT_DIR/bisources_PARTNER_GROUP_TYPE.sql
mysqlexec $BISOURCE_ROOT_DIR/bisources_PARTNER_SUB_ACTIVITY.sql
mysqlexec $BISOURCE_ROOT_DIR/bisources_UI_CONF_STATUS.sql
mysqlexec $BISOURCE_ROOT_DIR/bisources_UI_CONF_TYPE.sql
mysqlexec $BISOURCE_ROOT_DIR/bisources_WIDGET_SECURITY_POLICY.sql
mysqlexec $BISOURCE_ROOT_DIR/bisources_WIDGET_SECURITY_TYPE.sql
mysqlexec $BISOURCE_ROOT_DIR/bisources_control.sql
mysqlexec $BISOURCE_ROOT_DIR/bisources_event_type.sql
mysqlexec $BISOURCE_ROOT_DIR/bisources_gender.sql
mysqlexec $BISOURCE_ROOT_DIR/bisources_partner_status.sql
mysqlexec $BISOURCE_ROOT_DIR/bisources_partner_type.sql
mysqlexec $BISOURCE_ROOT_DIR/bisources_user_status.sql
mysqlexec $BISOURCE_ROOT_DIR/bisources_asset_status.sql
mysqlexec $BISOURCE_ROOT_DIR/bisources_file_sync_object_type.sql
mysqlexec $BISOURCE_ROOT_DIR/bisources_file_sync_status.sql
mysqlexec $BISOURCE_ROOT_DIR/bisources_ready_behavior.sql
mysqlexec $BISOURCE_ROOT_DIR/bisources_creation_mode.sql
mysqlexec $BISOURCE_ROOT_DIR/bisources_bandwidth_source.sql

#ds/
mysqlexec $DS_ROOT_DIR/files.sql
mysqlexec $DS_ROOT_DIR/events.sql
mysqlexec $DS_ROOT_DIR/invalid_event_lines.sql
mysqlexec $DS_ROOT_DIR/ods_fms_sessions_events.sql
mysqlexec $DS_ROOT_DIR/invalid_fms_event_lines.sql
mysqlexec $DS_ROOT_DIR/ds_events_partitions_view.sql
mysqlexec $DS_ROOT_DIR/add_ods_partition_procedure.sql
mysqlexec $DS_ROOT_DIR/drop_ods_partition_procedure.sql
mysqlexec $DS_ROOT_DIR/empty_ods_partition_procedure.sql
mysqlexec $DS_ROOT_DIR/empty_cycle_partition_procedure.sql
mysqlexec $DS_ROOT_DIR/transfer_ods_partition_procedure.sql
mysqlexec $DS_ROOT_DIR/add_file_partition_procedure.sql
mysqlexec $DS_ROOT_DIR/drop_file_partition_pocedure.sql
mysqlexec $DS_ROOT_DIR/empty_file_partition_procedure.sql
mysqlexec $DS_ROOT_DIR/transfer_file_partition_procedure.sql
mysqlexec $DS_ROOT_DIR/get_ip_country_location_function.sql
mysqlexec $DS_ROOT_DIR/restore_file_status_procedure.sql
mysqlexec $DS_ROOT_DIR/set_file_status_full_procedure.sql
mysqlexec $DS_ROOT_DIR/set_file_status_procedure.sql
mysqlexec $DS_ROOT_DIR/updated_entries.sql
mysqlexec $DS_ROOT_DIR/aggr_managment_procs.sql
mysqlexec $DS_ROOT_DIR/aggr_name_resolver.sql
mysqlexec $DS_ROOT_DIR/parameters.sql
mysqlexec $DS_ROOT_DIR/processes.sql
mysqlexec $DS_ROOT_DIR/staging_areas.sql
mysqlexec $DS_ROOT_DIR/populate_repository_for_events.sql
mysqlexec $DS_ROOT_DIR/populate_repository_for_fms_streaming.sql
mysqlexec $DS_ROOT_DIR/populate_repository_for_partner_activity.sql
mysqlexec $DS_ROOT_DIR/populate_repository_for_bandwidth_usage.sql
mysqlexec $DS_ROOT_DIR/fms_incomplete_session.sql
mysqlexec $DS_ROOT_DIR/fms_stale_sessions.sql
mysqlexec $DS_ROOT_DIR/fms_sessionize.sql
mysqlexec $DS_ROOT_DIR/cycles.sql
mysqlexec $DS_ROOT_DIR/get_error_code.sql
mysqlexec $DS_ROOT_DIR/insert_invalid_ds_line.sql
mysqlexec $DS_ROOT_DIR/invalid_ds_lines.sql
mysqlexec $DS_ROOT_DIR/invalid_ds_lines_error_codes.sql
mysqlexec $DS_ROOT_DIR/set_cycle_status.sql
mysqlexec $DS_ROOT_DIR/ds_bandwidth_usage.sql
mysqlexec $DS_ROOT_DIR/locks.sql
mysqlexec $DS_ROOT_DIR/populate_locks.sql
mysqlexec $DS_ROOT_DIR/pentaho_sequences.sql

#etl_log
mysqlexec $SQL_ROOT_DIR/log/etl_log.sql
#mysqlexec $SQL_ROOT_DIR/log/create_monitor_status.sql

#dw
mysqlexec $DW_ROOT_DIR/batch_jobs.sql
mysqlexec $DW_ROOT_DIR/bi_sources.sql
mysqlexec $DW_ROOT_DIR/dw_control.sql
mysqlexec $DW_ROOT_DIR/dw_domain.sql
mysqlexec $DW_ROOT_DIR/dw_EDITOR_TYPE.sql
mysqlexec $DW_ROOT_DIR/dw_ENTRY_MEDIA_SOURCE.sql
mysqlexec $DW_ROOT_DIR/dw_ENTRY_MEDIA_TYPE.sql
mysqlexec $DW_ROOT_DIR/dw_ENTRY_STATUS.sql
mysqlexec $DW_ROOT_DIR/dw_ENTRY_TYPE.sql
mysqlexec $DW_ROOT_DIR/dw_event_type.sql
mysqlexec $DW_ROOT_DIR/dw_gender.sql
mysqlexec $DW_ROOT_DIR/dw_MODERATION_STATUS.sql
mysqlexec $DW_ROOT_DIR/dw_PARTNER_ACTIVITY.sql
mysqlexec $DW_ROOT_DIR/dw_partner_group_type.sql
mysqlexec $DW_ROOT_DIR/dw_partner_status.sql
mysqlexec $DW_ROOT_DIR/dw_PARTNER_SUB_ACTIVITY.sql
mysqlexec $DW_ROOT_DIR/dw_partner_type.sql
mysqlexec $DW_ROOT_DIR/dw_UI_CONF_STATUS.sql
mysqlexec $DW_ROOT_DIR/dw_UI_CONF_TYPE.sql
mysqlexec $DW_ROOT_DIR/dw_user_status.sql
mysqlexec $DW_ROOT_DIR/dw_WIDGET_SECURITY_POLICY.sql
mysqlexec $DW_ROOT_DIR/dw_widget_security_type.sql
mysqlexec $DW_ROOT_DIR/entries.sql
mysqlexec $DW_ROOT_DIR/events.sql
mysqlexec $DW_ROOT_DIR/ip_ranges.sql
mysqlexec $DW_ROOT_DIR/kuser.sql
mysqlexec $DW_ROOT_DIR/locations.sql
mysqlexec $DW_ROOT_DIR/locations_init.sql
mysqlexec $DW_ROOT_DIR/Partner_Activities.sql
mysqlexec $DW_ROOT_DIR/partner.sql
mysqlexec $DW_ROOT_DIR/time.sql
mysqlexec $DW_ROOT_DIR/ui_conf.sql
mysqlexec $DW_ROOT_DIR/widget.sql
mysqlexec $DW_ROOT_DIR/countries_states_view.sql
mysqlexec $DW_ROOT_DIR/countries_view.sql
mysqlexec $DW_ROOT_DIR/dwh_fact_bandwidth_usage.sql
mysqlexec $DW_ROOT_DIR/dwh_fact_entries_sizes.sql
mysqlexec $DW_ROOT_DIR/calc_entries_sizes.sql
mysqlexec $DW_ROOT_DIR/generate_daily_usage_report.sql
mysqlexec $DW_ROOT_DIR/dwh_daily_usage_reports.sql

#dw/dimensions
mysqlexec $DW_ROOT_DIR/dimensions/dwh_dim_asset_status.sql
mysqlexec $DW_ROOT_DIR/dimensions/dwh_dim_audio_codec.sql
mysqlexec $DW_ROOT_DIR/dimensions/dwh_dim_container_format.sql
mysqlexec $DW_ROOT_DIR/dimensions/dwh_dim_file_ext.sql
mysqlexec $DW_ROOT_DIR/dimensions/dwh_dim_file_sync.sql
mysqlexec $DW_ROOT_DIR/dimensions/dwh_dim_file_sync_object_type.sql
mysqlexec $DW_ROOT_DIR/dimensions/dwh_dim_file_sync_status.sql
mysqlexec $DW_ROOT_DIR/dimensions/dwh_dim_flavor_asset.sql
mysqlexec $DW_ROOT_DIR/dimensions/dwh_dim_flavor_format.sql
mysqlexec $DW_ROOT_DIR/dimensions/dwh_dim_flavor_params.sql
mysqlexec $DW_ROOT_DIR/dimensions/dwh_dim_ready_behavior.sql
mysqlexec $DW_ROOT_DIR/dimensions/dwh_dim_video_codec.sql
mysqlexec $DW_ROOT_DIR/dimensions/dwh_dim_conversion_profile.sql
mysqlexec $DW_ROOT_DIR/dimensions/dwh_dim_creation_mode.sql
mysqlexec $DW_ROOT_DIR/dimensions/dwh_dim_flavor_params_conversion_profile.sql
mysqlexec $DW_ROOT_DIR/dimensions/dwh_dim_flavor_params_output.sql
mysqlexec $DW_ROOT_DIR/dimensions/dwh_dim_media_info.sql
mysqlexec $DW_ROOT_DIR/dimensions/dwh_dim_user_agent.sql
mysqlexec $DW_ROOT_DIR/dimensions/dwh_dim_bandwidth_source.sql
mysqlexec $DW_ROOT_DIR/dimensions/dwh_dim_referrer.sql

#dw/events
mysqlexec $DW_ROOT_DIR/events/dwh_fact_events_partitions_view.sql

#dw/maintenance
mysqlexec $DW_ROOT_DIR/maintenance/add_partition_procedure.sql
mysqlexec $DW_ROOT_DIR/maintenance/drop_events_partition_procedure.sql
mysqlexec $DW_ROOT_DIR/maintenance/drop_events_partition_procedure.sql

#dw/aggr
mysqlexec $DW_ROOT_DIR/aggr/aggr_managment.sql
mysqlexec $DW_ROOT_DIR/aggr/dwh_hourly_events_country.sql
mysqlexec $DW_ROOT_DIR/aggr/dwh_hourly_events_domain.sql
mysqlexec $DW_ROOT_DIR/aggr/dwh_hourly_events_domain_referrer.sql
mysqlexec $DW_ROOT_DIR/aggr/dwh_hourly_events_entry.sql
mysqlexec $DW_ROOT_DIR/aggr/dwh_hourly_events_widget.sql
mysqlexec $DW_ROOT_DIR/aggr/dwh_hourly_events_uid.sql
mysqlexec $DW_ROOT_DIR/aggr/dwh_hourly_partner.sql
mysqlexec $DW_ROOT_DIR/aggr/time_zone_helper_function.sql
mysqlexec $DW_ROOT_DIR/aggr/calc_aggr_day_procedure.sql
mysqlexec $DW_ROOT_DIR/aggr/calc_aggr_day_partner.sql
mysqlexec $DW_ROOT_DIR/aggr/calc_aggr_day_partner_bandwidth.sql
mysqlexec $DW_ROOT_DIR/aggr/calc_aggr_day_partner_storage.sql
mysqlexec $DW_ROOT_DIR/aggr/calc_aggr_day_partner_streaming.sql
mysqlexec $DW_ROOT_DIR/aggr/calc_aggr_day_partner_usage_totals.sql
mysqlexec $DW_ROOT_DIR/aggr/post_aggregation_dwh_hourly_events_widget.sql
mysqlexec $DW_ROOT_DIR/aggr/post_aggregation_dwh_hourly_partner.sql
mysqlexec $DW_ROOT_DIR/aggr/recalc_aggr_day_procedure.sql
mysqlexec $DW_ROOT_DIR/aggr/resolve_aggr_name_function.sql
mysqlexec $DW_ROOT_DIR/aggr/dwh_aggr_events_partitions_view.sql
mysqlexec $DW_ROOT_DIR/aggr/old_entries_table.sql

#ds sync with operational
mysqlexec $DS_ROOT_DIR/create_updated_entries_procedure.sql
mysqlexec $DS_ROOT_DIR/create_updated_kusers_storage_usage.sql

#dw/functions/
mysqlexec $DW_ROOT_DIR/functions/calc_month_id_function.sql
mysqlexec $DW_ROOT_DIR/functions/calc_prev_date_id_function.sql
mysqlexec $DW_ROOT_DIR/functions/primary_partner_functions.sql
mysqlexec $DW_ROOT_DIR/functions/top_activities_procedure.sql
mysqlexec $DW_ROOT_DIR/functions/calc_time_shift.sql
mysqlexec $DW_ROOT_DIR/functions/calc_partner_storage_data_time_range.sql

#dw/op_services/
mysqlexec $DW_ROOT_DIR/op_services/calc_partner_billing_data_procedure.sql
mysqlexec $DW_ROOT_DIR/op_services/monthly_non_paying_billing_report_procedure.sql
mysqlexec $DW_ROOT_DIR/op_services/monthly_partner_billing_report_procedure.sql

#dw/ri/ 
mysqlexec $DW_ROOT_DIR/ri/ri_defaults.sql
mysqlexec $DW_ROOT_DIR/ri/ri_mapping.sql
mysqlexec $DW_ROOT_DIR/ri/ri_defaults_grouped_view.sql
mysqlexec $DW_ROOT_DIR/ri/ri_mapping_and_defaults_view.sql

#dw/views/
mysqlexec $DW_ROOT_DIR/views/dwh_dim_entries_v.sql
mysqlexec $DW_ROOT_DIR/views/dwh_dim_partners_v.sql
mysqlexec $DW_ROOT_DIR/views/dwh_dim_uiconf_v.sql
mysqlexec $DW_ROOT_DIR/views/dwh_fact_events_v.sql
mysqlexec $DW_ROOT_DIR/views/dwh_fact_partner_activities_v.sql

#dw/fms/
mysqlexec $DW_ROOT_DIR/fms/fms_dim_tables.sql
mysqlexec $DW_ROOT_DIR/fms/dwh_fact_fms_sessions.sql
mysqlexec $DW_ROOT_DIR/fms/dwh_fact_fms_session_events.sql
 
 #populate data
 # runnig the ETL is the better way to populate the dwh_dim_time table
 export KETTLE_HOME=$ROOT_DIR
 sh $KITCHEN/kitchen.sh /file $ETL_ROOT_DIR/create_time_dim.kjb

 # Check that the command didn't fail
        ret_val=$?
        if [ $ret_val -ne 0 ];then
                        echo $ret_val
                        echo "Error - bailing out!"
                        exit
        fi

mysqlexec $DW_ROOT_DIR/maintenance/populate_table_partitions.sql
#mysqlexec $SETUP_ROOT_DIR/populate_time_table.sql
mysqlexec $SETUP_ROOT_DIR/populate_aggr_managment_table.sql
#mysqlexec $SETUP_ROOT_DIR/populate_old_entries.sql
mysqlexec $SETUP_ROOT_DIR/populate_dwh_dim_ip_ranges.sql
/bin/cp -r $ROOT_DIR/pentaho-plugins/MySQLInserter32/MySQLInserter $KITCHEN/plugins/steps/
/bin/cp -r $ROOT_DIR/pentaho-plugins/MappingFieldRunner32/MappingFieldRunner $KITCHEN/plugins/steps/
