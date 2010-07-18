use kalturadw;
update 
	dwh_fact_events ev,dwh_dim_entries en
set 
	ev.entry_media_type_id=en.entry_media_type_id
where 
	ev.entry_id=en.entry_id 
	AND ev.entry_media_type_id is null
	AND ev.event_date_id>"20090718";