DROP TABLE IF EXISTS `kalturadw_bisources`.`bisources_partner_group_type`;

CREATE TABLE `kalturadw_bisources`.`bisources_partner_group_type` (
  `partner_group_type_id` SMALLINT NOT NULL ,
  `partner_group_type_name` VARCHAR(50),
  PRIMARY KEY (`partner_group_type_id`)
  
) ENGINE=MYISAM  DEFAULT CHARSET=utf8;


INSERT INTO `kalturadw_bisources`.`bisources_partner_group_type`  
	VALUES
	(1,'PARTNER_GROUP_TYPE_PUBLISHER'),
	(2,'PARTNER_GROUP_TYPE_VAR'),
	(3,'PARTNER_GROUP_TYPE_GROUP');
