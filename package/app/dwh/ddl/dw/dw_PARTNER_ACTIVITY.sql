DROP TABLE IF EXISTS `kalturadw`.`dwh_dim_partner_activity`;

CREATE TABLE `kalturadw`.`dwh_dim_partner_activity` (
  `partner_activity_id` SMALLINT NOT NULL ,
  `partner_activity_name` VARCHAR(50),
   dwh_creation_date TIMESTAMP NOT NULL DEFAULT 0,
   dwh_update_date TIMESTAMP NOT NULL DEFAULT NOW() ON UPDATE NOW(),
   ri_ind TINYINT NOT NULL DEFAULT '0',
  PRIMARY KEY (`partner_activity_id`)
  
) ENGINE=MYISAM  DEFAULT CHARSET=utf8;


CREATE TRIGGER `kalturadw`.`dwh_dim_partner_activity_setcreationtime_oninsert` BEFORE INSERT
    ON `kalturadw`.`dwh_dim_partner_activity`
    FOR EACH ROW 
	SET new.dwh_creation_date = NOW();
	
