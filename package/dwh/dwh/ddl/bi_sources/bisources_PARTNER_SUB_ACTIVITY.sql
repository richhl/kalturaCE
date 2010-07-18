DROP TABLE IF EXISTS `kalturadw_bisources`.`bisources_partner_sub_activity`;

CREATE TABLE `kalturadw_bisources`.`bisources_partner_sub_activity` (
  `partner_sub_activity_id` SMALLINT NOT NULL ,
  `partner_sub_activity_name` VARCHAR(50),
  PRIMARY KEY (`partner_sub_activity_id`)
  
) ENGINE=MYISAM  DEFAULT CHARSET=utf8;


INSERT INTO kalturadw_bisources.bisources_PARTNER_SUB_ACTIVITY (PARTNER_SUB_ACTIVITY_id,PARTNER_SUB_ACTIVITY_name) VALUES(1,'WWW'); 
INSERT INTO kalturadw_bisources.bisources_PARTNER_SUB_ACTIVITY (PARTNER_SUB_ACTIVITY_id,PARTNER_SUB_ACTIVITY_name) VALUES(2,'LIMELIGHT'); 
INSERT INTO kalturadw_bisources.bisources_PARTNER_SUB_ACTIVITY (PARTNER_SUB_ACTIVITY_id,PARTNER_SUB_ACTIVITY_name) VALUES(201,'KDP_PLAYS'); 
INSERT INTO kalturadw_bisources.bisources_PARTNER_SUB_ACTIVITY (PARTNER_SUB_ACTIVITY_id,PARTNER_SUB_ACTIVITY_name) VALUES(202,'KDP_VIEWS'); 
INSERT INTO kalturadw_bisources.bisources_PARTNER_SUB_ACTIVITY (PARTNER_SUB_ACTIVITY_id,PARTNER_SUB_ACTIVITY_name) VALUES(301,'STORAGE_SIZE'); 
INSERT INTO kalturadw_bisources.bisources_PARTNER_SUB_ACTIVITY (PARTNER_SUB_ACTIVITY_id,PARTNER_SUB_ACTIVITY_name) VALUES(302,'STORAGE_COUNT'); 
INSERT INTO kalturadw_bisources.bisources_PARTNER_SUB_ACTIVITY (PARTNER_SUB_ACTIVITY_id,PARTNER_SUB_ACTIVITY_name) VALUES(401,'MEDIA'); 
INSERT INTO kalturadw_bisources.bisources_PARTNER_SUB_ACTIVITY (PARTNER_SUB_ACTIVITY_id,PARTNER_SUB_ACTIVITY_name) VALUES(501,'USER'); 
