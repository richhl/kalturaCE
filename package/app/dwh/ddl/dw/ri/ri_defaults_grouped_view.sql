USE kalturadw;

DELIMITER $$

DROP VIEW IF EXISTS `kalturadw`.`ri_defaults_grouped`$$

CREATE ALGORITHM=UNDEFINED DEFINER=`etl`@`localhost` SQL SECURITY DEFINER VIEW kalturadw.`ri_defaults_grouped` AS (SELECT `ri_defaults`.`table_name` AS `table_name`,GROUP_CONCAT(`ri_defaults`.`default_field` ORDER BY `ri_defaults`.`default_field` ASC SEPARATOR ',') AS `default_fields`,CONCAT('"',GROUP_CONCAT(`ri_defaults`.`default_value` ORDER BY `ri_defaults`.`default_field` ASC SEPARATOR '","'),'"') AS `default_values` FROM kalturadw.`ri_defaults` GROUP BY `ri_defaults`.`table_name`)$$

DELIMITER ;