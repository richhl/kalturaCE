DELIMITER $$

DROP PROCEDURE IF EXISTS `agg_new_fms_to_partner_activity` $$
CREATE DEFINER=`etl`@`localhost` PROCEDURE `agg_new_fms_to_partner_activity`()
BEGIN
  DECLARE DEFAULT_ACTIVITY_ID integer;
  DECLARE STREAMING_ACTIVITY_ID integer;
  DECLARE STREAMING_SUB_ACTIVITY integer;
  SET DEFAULT_ACTIVITY_ID = 1;
  SET STREAMING_ACTIVITY_ID = 7;
  SET STREAMING_SUB_ACTIVITY = 700;

  insert into kalturadw.dwh_fact_partner_activities
  (activity_id,partner_id,activity_date,activity_date_id,activity_hour_id,partner_activity_id,partner_sub_activity_id,amount)
  select DEFAULT_ACTIVITY_ID,session_partner_id,date(session_time),session_date_id,0 hour_id,STREAMING_ACTIVITY_ID,STREAMING_SUB_ACTIVITY,sum(total_bytes)
  from kalturadw.dwh_fact_fms_sessions
  where session_date_id in (
    select distinct aggr_day_int
    from kalturadw.aggr_managment
    where aggr_name = 'fms_sessions' and is_calculated = 0 and aggr_day <= now())
  group by session_partner_id,date(session_time),session_date_id
  on duplicate key update
    amount=values(amount);

  update kalturadw.aggr_managment
  set is_calculated = 1
  where aggr_name = 'fms_sessions' and aggr_day <= now();
END $$

DELIMITER ;