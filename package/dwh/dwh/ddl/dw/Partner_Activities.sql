DROP TABLE IF EXISTS `kalturadw`.dwh_fact_partner_activities;

CREATE TABLE `kalturadw`.`dwh_fact_partner_activities` (                                                    
	    `activity_id` INT NOT NULL,                                              
	    `partner_id` INT DEFAULT -1,                                                 
	    `activity_date` DATE DEFAULT NULL,
	     activity_date_id INT DEFAULT '-1',
	     activity_hour_id TINYINT DEFAULT '-1',                                                 
	    `partner_activity_id` SMALLINT DEFAULT -1,                                                   
	    `partner_sub_activity_id` SMALLINT DEFAULT -1,                                               
	    `amount` BIGINT DEFAULT NULL,                                                     
	    `amount1` BIGINT DEFAULT '0',                                                     
	    `amount2` BIGINT DEFAULT '0',                                                     
	    `amount3` INT DEFAULT '0',                                                     
	    `amount4` INT DEFAULT '0',                                                     
	    `amount5` INT DEFAULT '0',                                                     
	    `amount6` INT DEFAULT '0',                                                     
	    `amount7` INT DEFAULT '0',                                                     
	    `amount8` INT DEFAULT '0',                                                     
	    `amount9` INT DEFAULT '0',                                                     
	    dwh_creation_date TIMESTAMP NOT NULL DEFAULT 0,
	    dwh_update_date TIMESTAMP NOT NULL DEFAULT NOW() ON UPDATE NOW(),
 	    ri_ind TINYINT NOT NULL DEFAULT '0',
	    PRIMARY KEY (`activity_id`),                                                                
	    UNIQUE KEY `partner_id` (`partner_id`,`activity_date`,`partner_activity_id`,`partner_sub_activity_id`),  
	    KEY `partner_activity_id` (`partner_activity_id`),
		KEY `partner_sub_activity_id` (`partner_sub_activity_id`),                                             
	    KEY `dwh_update_date` (`dwh_update_date`)                                              
	  ) ENGINE=MYISAM DEFAULT CHARSET=utf8;
	  
CREATE TRIGGER `kalturadw`.`dwh_fact_partner_activities_setcreationtime_oninsert` BEFORE INSERT
    ON `kalturadw`.`dwh_fact_partner_activities`
    FOR EACH ROW 
	SET new.dwh_creation_date = NOW();  
