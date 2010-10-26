insert into dwh_widget_count 
(event_date_id,partner_id,widget_id,event_type_id,_count)
select event_date_id,partner_id,widget_id,event_type_id,count(1) _count
from kalturadw.dwh_fact_events 
where event_date_id>=20090924 and partner_id=2217 and event_type_id<8
group by event_date_id,partner_id,widget_id,event_type_id;