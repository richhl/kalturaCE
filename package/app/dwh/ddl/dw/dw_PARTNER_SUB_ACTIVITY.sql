DROP TABLE IF EXISTS `kalturadw`.`dwh_dim_partner_sub_activity`;

CREATE TABLE `kalturadw`.`dwh_dim_partner_sub_activity` (
  `partner_sub_activity_id` SMALLINT NOT NULL ,
  `partner_sub_activity_name` VARCHAR(50),
   dwh_creation_date TIMESTAMP NOT NULL DEFAULT 0,
   dwh_update_date TIMESTAMP NOT NULL DEFAULT NOW() ON UPDATE NOW(),
   ri_ind TINYINT NOT NULL DEFAULT '0',
  PRIMARY KEY (`partner_sub_activity_id`)
  
) ENGINE=MYISAM  DEFAULT CHARSET=utf8; 


create trigger `kalturadw`.`dwh_dim_partner_sub_activity_setcreationtime_oninsert` before insert
    on `kalturadw`.`dwh_dim_partner_sub_activity`
    for each row 
	set new.dwh_creation_date = now();
	
