DELIMITER $$

DROP VIEW IF EXISTS `kalturadw`.`ri_mapping_and_defaults`$$

CREATE ALGORITHM=UNDEFINED DEFINER=`etl`@`localhost` SQL SECURITY DEFINER VIEW kalturadw.`ri_mapping_and_defaults` AS (SELECT `m`.`table_name` AS `table_name`,`m`.`column_name` AS `column_name`,`m`.`date_id_column_name` AS `date_id_column_name`,`m`.`reference_table` AS `reference_table`,`m`.`reference_column` AS `reference_column`,`m`.`perform_check` AS `perform_check`,`dg`.`default_fields` AS `default_fields`,`dg`.`default_values` AS `default_values` FROM (kalturadw.`ri_mapping` `m` JOIN kalturadw.`ri_defaults_grouped` `dg`) WHERE (`m`.`reference_table` = `dg`.`table_name`))$$

DELIMITER ;