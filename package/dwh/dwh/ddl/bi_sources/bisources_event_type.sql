DROP TABLE IF EXISTS `kalturadw_bisources`.`bisources_event_type`;

CREATE TABLE `kalturadw_bisources`.`bisources_event_type` (
  `event_type_id` SMALLINT NOT NULL ,
  `event_type_name` VARCHAR(50) DEFAULT 'missing value',
  PRIMARY KEY (`event_type_id`)
) ENGINE=MYISAM  DEFAULT CHARSET=utf8;



INSERT INTO kalturadw_bisources.bisources_event_type (event_type_id,event_type_name) VALUES(1,'Widget Loaded'); 
INSERT INTO kalturadw_bisources.bisources_event_type (event_type_id,event_type_name) VALUES(2,'Media Loaded (view)'); 
INSERT INTO kalturadw_bisources.bisources_event_type (event_type_id,event_type_name) VALUES(3,'Play'); 
INSERT INTO kalturadw_bisources.bisources_event_type (event_type_id,event_type_name) VALUES(4,'Play reached 25%'); 
INSERT INTO kalturadw_bisources.bisources_event_type (event_type_id,event_type_name) VALUES(5,'Play reached 50%'); 
INSERT INTO kalturadw_bisources.bisources_event_type (event_type_id,event_type_name) VALUES(6,'Play reached 75%'); 
INSERT INTO kalturadw_bisources.bisources_event_type (event_type_id,event_type_name) VALUES(7,'Play reached 100%'); 
INSERT INTO kalturadw_bisources.bisources_event_type (event_type_id,event_type_name) VALUES(8,'Open Edit'); 
INSERT INTO kalturadw_bisources.bisources_event_type (event_type_id,event_type_name) VALUES(9,'Open Viral'); 
INSERT INTO kalturadw_bisources.bisources_event_type (event_type_id,event_type_name) VALUES(10,'Open Download'); 
INSERT INTO kalturadw_bisources.bisources_event_type (event_type_id,event_type_name) VALUES(11,'Open Report'); 
INSERT INTO kalturadw_bisources.bisources_event_type (event_type_id,event_type_name) VALUES(12,'Buffer Start'); 
INSERT INTO kalturadw_bisources.bisources_event_type (event_type_id,event_type_name) VALUES(13,'Buffer End'); 
INSERT INTO kalturadw_bisources.bisources_event_type (event_type_id,event_type_name) VALUES(14,'Open Full Screen'); 
INSERT INTO kalturadw_bisources.bisources_event_type (event_type_id,event_type_name) VALUES(15,'Close Full Screen'); 
INSERT INTO kalturadw_bisources.bisources_event_type (event_type_id,event_type_name) VALUES(16,'Replay'); 
INSERT INTO kalturadw_bisources.bisources_event_type (event_type_id,event_type_name) VALUES(17,'Seek'); 
INSERT INTO kalturadw_bisources.bisources_event_type (event_type_id,event_type_name) VALUES(18,'Open Upload'); 
INSERT INTO kalturadw_bisources.bisources_event_type (event_type_id,event_type_name) VALUES(19,'Save & Publish'); 
INSERT INTO kalturadw_bisources.bisources_event_type (event_type_id,event_type_name) VALUES(20,'Close Edtior'); 
INSERT INTO kalturadw_bisources.bisources_event_type (event_type_id,event_type_name) VALUES(21,'Pre Bumper Played');
INSERT INTO kalturadw_bisources.bisources_event_type (event_type_id,event_type_name) VALUES(22,'Post Bumper Played');
INSERT INTO kalturadw_bisources.bisources_event_type (event_type_id,event_type_name) VALUES(23,'Bumper Clicked');
