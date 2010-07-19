select 
	event_date_id,
	dwh_fact_events.event_type_id,
	dwh_dim_event_type.event_type_name,
	count(1) 
from 
	dwh_fact_events,
	dwh_dim_event_type  
where 
	dwh_fact_events.event_type_id=dwh_dim_event_type.event_type_id 
	and  event_date_id between "20090726" and "20090728" 
group by event_date_id,event_type_id;
