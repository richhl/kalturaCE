DROP TABLE IF EXISTS `kalturadw_bisources`.`bisources_ui_conf_type`;

CREATE TABLE `kalturadw_bisources`.`bisources_ui_conf_type` (
  `ui_conf_type_id` SMALLINT NOT NULL ,
  `ui_conf_type_name` VARCHAR(50) DEFAULT 'missing value',

  PRIMARY KEY (`ui_conf_type_id`)
) ENGINE=MYISAM  DEFAULT CHARSET=utf8;


	
INSERT INTO kalturadw_bisources.bisources_UI_CONF_TYPE (UI_CONF_TYPE_id,UI_CONF_TYPE_name) VALUES(1,'WIDGET'); 
INSERT INTO kalturadw_bisources.bisources_UI_CONF_TYPE (UI_CONF_TYPE_id,UI_CONF_TYPE_name) VALUES(2,'CW'); 
INSERT INTO kalturadw_bisources.bisources_UI_CONF_TYPE (UI_CONF_TYPE_id,UI_CONF_TYPE_name) VALUES(3,'EDITOR'); 
INSERT INTO kalturadw_bisources.bisources_UI_CONF_TYPE (UI_CONF_TYPE_id,UI_CONF_TYPE_name) VALUES(4,'ADVANCED_EDITOR'); 
INSERT INTO kalturadw_bisources.bisources_UI_CONF_TYPE (UI_CONF_TYPE_id,UI_CONF_TYPE_name) VALUES(5,'PLAYLIST'); 
INSERT INTO kalturadw_bisources.bisources_UI_CONF_TYPE (UI_CONF_TYPE_id,UI_CONF_TYPE_name) VALUES(6,'APP_STUDIO'); 
