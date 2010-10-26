#!/bin/bash
USER="etl"
PW="etl"
KITCHEN=/usr/local/pentaho/pdi
ROOT_DIR=/home/etl

while getopts "u:p:k:d:" o
do	case "$o" in
	u)	UESR="$OPTARG";;
	p)	PW="$OPTARG";;
    k)	KITCHEN="$OPTARG";;
    d)	ROOT_DIR="$OPTARG";;
	[?])	echo >&2 "Usage: $0 [-u username] [-p password] [-k  pdi-path] [-d dwh-path]"
		exit 1;;
	esac
done

function mysqlexec {
        echo "now executing $1"
        mysql -u $USER -p$PW < $1 >>  $SQL_LOG

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

#ds/
mysqlexec $DS_ROOT_DIR/files.sql
mysqlexec $DS_ROOT_DIR/events.sql
mysqlexec $DS_ROOT_DIR/invalid_event_lines.sql
mysqlexec $DS_ROOT_DIR/ds_events_partitions_view.sql
mysqlexec $DS_ROOT_DIR/add_ods_partition_procedure.sql
mysqlexec $DS_ROOT_DIR/drop_ods_partition_procedure.sql
mysqlexec $DS_ROOT_DIR/empty_ods_partition_procedure.sql
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

#dw/events
mysqlexec $DW_ROOT_DIR/events/dwh_fact_events_partitions_view.sql

#dw/maintenance
mysqlexec $DW_ROOT_DIR/maintenance/add_partition_procedure.sql
mysqlexec $DW_ROOT_DIR/maintenance/drop_events_partition_procedure.sql

#dw/aggr
mysqlexec $DW_ROOT_DIR/aggr/aggr_events_country.sql
mysqlexec $DW_ROOT_DIR/aggr/aggr_events_domain.sql
mysqlexec $DW_ROOT_DIR/aggr/aggr_events_entry.sql
mysqlexec $DW_ROOT_DIR/aggr/aggr_events_widget.sql
mysqlexec $DW_ROOT_DIR/aggr/aggr_events_uid.sql
mysqlexec $DW_ROOT_DIR/aggr/aggr_managment.sql
mysqlexec $DW_ROOT_DIR/aggr/aggr_partner_daily_usage.sql
mysqlexec $DW_ROOT_DIR/aggr/aggr_partner_monthly.sql
mysqlexec $DW_ROOT_DIR/aggr/aggr_partner.sql
mysqlexec $DW_ROOT_DIR/aggr/calc_aggr_day_procedure.sql
mysqlexec $DW_ROOT_DIR/aggr/daily_procedure_dwh_aggr_events_widget.sql
mysqlexec $DW_ROOT_DIR/aggr/daily_procedure_dwh_aggr_partner_daily_usage.sql
mysqlexec $DW_ROOT_DIR/aggr/daily_procedure_dwh_aggr_partner.sql
mysqlexec $DW_ROOT_DIR/aggr/recalc_aggr_day_procedure.sql
mysqlexec $DW_ROOT_DIR/aggr/resolve_aggr_name_function.sql
mysqlexec $DW_ROOT_DIR/aggr/dwh_aggr_events_partitions_view.sql
mysqlexec $DW_ROOT_DIR/aggr/old_entries_table.sql

#ds play/view sync with operational
mysqlexec $DS_ROOT_DIR/create_updated_entries_procedure.sql

#dw/functions/
mysqlexec $DW_ROOT_DIR/functions/calc_month_id_function.sql
mysqlexec $DW_ROOT_DIR/functions/calc_prev_date_id_function.sql
mysqlexec $DW_ROOT_DIR/functions/primary_partner_functions.sql
mysqlexec $DW_ROOT_DIR/functions/top_activities_procedure.sql

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
mysqlexec $DW_ROOT_DIR/views/dwh_aggr_active_partners_v.sql
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

 #mysqlexec $SETUP_ROOT_DIR/populate_time_table.sql
 mysqlexec $SETUP_ROOT_DIR/populate_aggr_managment_table.sql
 #mysqlexec $SETUP_ROOT_DIR/populate_old_entries.sql
 mysqlexec $SETUP_ROOT_DIR/populate_dwh_dim_ip_ranges.sql
