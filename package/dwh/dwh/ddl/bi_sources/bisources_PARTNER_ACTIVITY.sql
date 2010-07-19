DROP TABLE IF EXISTS `kalturadw_bisources`.`bisources_partner_activity`;

CREATE TABLE `kalturadw_bisources`.`bisources_partner_activity` (
  `partner_activity_id` SMALLINT NOT NULL ,
  `partner_activity_name` VARCHAR(50),
  PRIMARY KEY (`partner_activity_id`)
  
) ENGINE=MYISAM  DEFAULT CHARSET=utf8;

INSERT INTO kalturadw_bisources.bisources_PARTNER_ACTIVITY (PARTNER_ACTIVITY_id,PARTNER_ACTIVITY_name) VALUES(1,'TRAFFIC'); 
INSERT INTO kalturadw_bisources.bisources_PARTNER_ACTIVITY (PARTNER_ACTIVITY_id,PARTNER_ACTIVITY_name) VALUES(2,'KPD'); 
INSERT INTO kalturadw_bisources.bisources_PARTNER_ACTIVITY (PARTNER_ACTIVITY_id,PARTNER_ACTIVITY_name) VALUES(3,'STORAGE'); 
INSERT INTO kalturadw_bisources.bisources_PARTNER_ACTIVITY (PARTNER_ACTIVITY_id,PARTNER_ACTIVITY_name) VALUES(4,'MEDIA'); 
INSERT INTO kalturadw_bisources.bisources_PARTNER_ACTIVITY (PARTNER_ACTIVITY_id,PARTNER_ACTIVITY_name) VALUES(5,'USER'); 
