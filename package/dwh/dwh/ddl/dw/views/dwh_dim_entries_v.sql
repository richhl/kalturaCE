DELIMITER $$

USE `kalturadw`$$

DROP VIEW IF EXISTS `dwh_dim_entries_v`$$

CREATE ALGORITHM=UNDEFINED DEFINER=`etl`@`%` SQL SECURITY DEFINER VIEW `dwh_dim_entries_v` AS 
SELECT
  `a`.`entry_id`              AS `entry_id`,
  `a`.`entry_name`            AS `entry_name`,
  `a`.`partner_id`            AS `partner_id`,
  `a`.`entry_source_id`       AS `entry_source_id`,
  `a`.`created_at`            AS `created_at`,
  `a`.`created_date_id`       AS `created_date_id`,
  `a`.`created_hour_id`       AS `created_hour_id`,
  `a`.`updated_date_id`       AS `updated_date_id`,
  `a`.`updated_hour_id`       AS `updated_hour_id`,
  `a`.`entry_type_id`         AS `entry_type_id`,
  `c`.`entry_type_name`       AS `entry_type_Name`,
  `b`.`entry_status_id`       AS `entry_status_id`,
  `b`.`entry_status_name`     AS `entry_status_Name`,
  `d`.`entry_media_type_id`   AS `entry_media_type_id`,
  `d`.`entry_media_type_name` AS `entry_media_type_name`
FROM (((`dwh_dim_entries` `a`
     LEFT JOIN `dwh_dim_entry_status` `b`
       ON ((`a`.`entry_status_id` = `b`.`entry_status_id`)))
    LEFT JOIN `dwh_dim_entry_type` `c`
      ON ((`a`.`entry_type_id` = `c`.`entry_type_id`)))
   LEFT JOIN `dwh_dim_entry_media_type` `d`
     ON ((`a`.`entry_media_type_id` = `d`.`entry_media_type_id`)))
WHERE (`a`.`created_at` > (CURDATE() + INTERVAL - (90)DAY))$$

DELIMITER ;