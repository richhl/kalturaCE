DELIMITER $$

USE `kalturadw`$$

DROP VIEW IF EXISTS `dwh_fact_partner_activities_v`$$

CREATE ALGORITHM=UNDEFINED DEFINER=`etl`@`%` SQL SECURITY DEFINER VIEW `dwh_fact_partner_activities_v` AS (
SELECT
  `dwh_fact_partner_activities`.`activity_id`             AS `activity_id`,
  `dwh_fact_partner_activities`.`partner_id`              AS `partner_id`,
  `dwh_fact_partner_activities`.`activity_date`           AS `activity_date`,
  `dwh_fact_partner_activities`.`activity_date_id`        AS `activity_date_id`,
  `dwh_fact_partner_activities`.`activity_hour_id`        AS `activity_hour_id`,
  `dwh_fact_partner_activities`.`partner_activity_id`     AS `partner_activity_id`,
  `dwh_fact_partner_activities`.`partner_sub_activity_id` AS `partner_sub_activity_id`,
  `dwh_fact_partner_activities`.`amount`                  AS `amount`,
  `dwh_fact_partner_activities`.`amount1`                 AS `amount1`,
  `dwh_fact_partner_activities`.`amount2`                 AS `amount2`,
  `dwh_fact_partner_activities`.`amount3`                 AS `amount3`,
  `dwh_fact_partner_activities`.`amount4`                 AS `amount4`,
  `dwh_fact_partner_activities`.`amount5`                 AS `amount5`,
  `dwh_fact_partner_activities`.`amount6`                 AS `amount6`,
  `dwh_fact_partner_activities`.`amount7`                 AS `amount7`,
  `dwh_fact_partner_activities`.`amount8`                 AS `amount8`,
  `dwh_fact_partner_activities`.`amount9`                 AS `amount9`,
  `dwh_fact_partner_activities`.`dwh_creation_date`       AS `dwh_creation_date`,
  `dwh_fact_partner_activities`.`dwh_update_date`         AS `dwh_update_date`,
  `dwh_fact_partner_activities`.`ri_ind`                  AS `ri_ind`
FROM `dwh_fact_partner_activities`
LIMIT 1000)$$

DELIMITER ;