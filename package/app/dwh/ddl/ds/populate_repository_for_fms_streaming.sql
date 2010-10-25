insert into kalturadw_ds.processes (id,process_name) values (2,'fms_streaming');

insert into kalturadw_ds.staging_areas (id,process_id,source_table,target_table,on_duplicate_clause,staging_partition_field)
values
(2,2,'ods_fms_session_events','kalturadw.dwh_fact_fms_session_events','ON DUPLICATE KEY UPDATE kalturadw.dwh_fact_fms_session_events.file_id = kalturadw.dwh_fact_fms_session_events.file_id','file_id');
