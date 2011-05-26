DROP TABLE IF EXISTS `kalturadw_bisources`.`bisources_editor_type`;

CREATE TABLE `kalturadw_bisources`.`bisources_editor_type` (
  `editor_type_id` SMALLINT NOT NULL ,
  `editor_type_name` VARCHAR(50),
  PRIMARY KEY (`editor_type_id`)
  
) ENGINE=MYISAM  DEFAULT CHARSET=utf8;

INSERT INTO kalturadw_bisources.bisources_EDITOR_TYPE (EDITOR_TYPE_id,EDITOR_TYPE_name) VALUES(-1,''); 
INSERT INTO kalturadw_bisources.bisources_EDITOR_TYPE (EDITOR_TYPE_id,EDITOR_TYPE_name) VALUES(1,'Simple'); 
INSERT INTO kalturadw_bisources.bisources_EDITOR_TYPE (EDITOR_TYPE_id,EDITOR_TYPE_name) VALUES(2,'Keditor '); 
INSERT INTO kalturadw_bisources.bisources_EDITOR_TYPE (EDITOR_TYPE_id,EDITOR_TYPE_name) VALUES(3,'QuickEdit '); 
INSERT INTO kalturadw_bisources.bisources_EDITOR_TYPE (EDITOR_TYPE_id,EDITOR_TYPE_name) VALUES(4,'kalturaSimpleEditor'); 
