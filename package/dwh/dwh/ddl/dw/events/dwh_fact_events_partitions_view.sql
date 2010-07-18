DELIMITER $$

DROP VIEW IF EXISTS `kalturadw`.`dwh_fact_events_partitions`$$

CREATE ALGORITHM=UNDEFINED DEFINER=`etl`@`%` SQL SECURITY DEFINER VIEW kalturadw.`dwh_fact_events_partitions` AS SELECT `partitions`.`TABLE_NAME` AS `table_name`,`partitions`.`PARTITION_NAME` AS `partition_name`,`partitions`.`PARTITION_DESCRIPTION` AS `partition_description`,`partitions`.`TABLE_ROWS` AS `table_rows`,`partitions`.`CREATE_TIME` AS `create_time` FROM `information_schema`.`partitions` WHERE (`partitions`.`TABLE_NAME` = 'dwh_fact_events')$$

DELIMITER ;