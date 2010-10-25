DELIMITER $$

USE `kalturadw`$$

DROP VIEW IF EXISTS `dwh_aggr_active_partners_v`$$

CREATE ALGORITHM=TEMPTABLE   DEFINER=`etl`@`%` SQL SECURITY DEFINER VIEW `dwh_aggr_active_partners_v` AS (
SELECT
	a.partner_id AS `partner_id`,
	a.month_id AS `month_id`,
	a.last_calculated_date_id AS `date_id`,
	a.flag_active_site     			AS `active_site`,
	a.flag_active_publisher   		AS `active_partner`
FROM
	dwh_aggr_monthly_partner a 
)$$

DELIMITER ;