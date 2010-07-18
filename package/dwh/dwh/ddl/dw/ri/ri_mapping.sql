/*
SQLyog Community Edition- MySQL GUI
MySQL - 5.1.34-community 
*********************************************************************
*/
/*!40101 SET NAMES utf8 */;

CREATE TABLE kalturadw.`ri_mapping` (
	`table_name` VARCHAR (300),
	`column_name` VARCHAR (300),
	`date_id_column_name` VARCHAR (300),
	`reference_table` VARCHAR (300),
	`reference_column` VARCHAR (300),
	`perform_check` TINYINT (1),
	UNIQUE KEY `table_name` (`table_name`,`column_name`)
);

INSERT INTO kalturadw.`ri_mapping` (`table_name`, `column_name`, `date_id_column_name`, `reference_table`, `reference_column`, `perform_check`) 
	VALUES
	('dwh_dim_Kusers','partner_id','dwh_update_date', 'dwh_dim_Partners','partner_id','1'),
	('dwh_dim_Kusers','kuser_status_id','dwh_update_date','dwh_dim_user_status','user_status_id','1'),
	('dwh_dim_UI_Conf','ui_conf_type_id','dwh_update_date','dwh_dim_UI_conf_type','ui_conf_type_id','1'),
	('dwh_dim_UI_Conf','ui_conf_status_id','dwh_update_date','dwh_dim_UI_conf_status','ui_conf_status_id','1'),
	('dwh_dim_UI_Conf','partner_id','dwh_update_date','dwh_dim_Partners','partner_id','1'),
	('dwh_dim_Widget','source_widget_id','dwh_update_date','dwh_dim_Widget','widget_id','1'),
	('dwh_dim_Widget','root_widget_id','dwh_update_date','dwh_dim_Widget','widget_id','1'),
	('dwh_dim_Widget','partner_id','dwh_update_date','dwh_dim_Partners','partner_id','1'),
	('dwh_dim_Widget','Entry_ID','dwh_update_date','dwh_dim_Entries','entry_id','1'),
	('dwh_dim_Widget','ui_conf_id','dwh_update_date','dwh_dim_UI_Conf','ui_conf_id','1'),
	('dwh_dim_Entries','kuser_id','dwh_update_date','dwh_dim_Kusers','kuser_id','1'),
	('dwh_dim_Entries','entry_Type_ID','dwh_update_date','dwh_dim_Entry_Type','entry_type_id','1'),
	('dwh_dim_Entries','entry_Media_Type_ID','dwh_update_date','dwh_dim_Entry_Media_Type','entry_media_type_id','1'),
	('dwh_dim_Entries','Entry_Status_ID','dwh_update_date','dwh_dim_Entry_Status','entry_status_id','1'),
	('dwh_dim_Entries','entry_media_Source_id','dwh_update_date','dwh_dim_Entry_Media_Source','entry_media_source_id','1'),
	('dwh_dim_Entries','partner_id','dwh_update_date','dwh_dim_Partners','partner_id','1'),
	('dwh_dim_Entries','moderation_status','dwh_update_date','dwh_dim_moderation_status','moderation_status_id','1'),
	('dwh_dim_Partners','Partner_Status_ID','dwh_update_date','dwh_dim_partner_status','Partner_Status_ID','1'),
	('dwh_dim_Partners','Partner_Type_ID','dwh_update_date','dwh_dim_partner_type','Partner_Type_ID','1'),
	('dwh_fact_Partner_Activities','partner_id','dwh_update_date','dwh_dim_partners','partner_id','1'),
	('dwh_fact_Partner_Activities','partner_activity_id','dwh_update_date','dwh_dim_partner_activity','partner_activity_id','1'),
	('dwh_fact_Partner_Activities','partner_sub_activity_id','dwh_update_date','dwh_dim_partner_sub_activity','partner_sub_activity_id','1'),
	('dwh_fact_Events','Partner_id','event_date_id','dwh_dim_Partners','partner_id','1'),
	('dwh_fact_Events','Entry_id','event_date_id','dwh_dim_Entries','entry_id','1'),
	('dwh_fact_Events','UI_Conf_id','event_date_id','dwh_dim_UI_Conf','ui_conf_id','1'),
	('dwh_fact_Events','widget_id','event_date_id','dwh_dim_widget','widget_id','1'),
	('dwh_fact_Events','location_id','event_date_id','dwh_dim_locations','location_id','1'),
	('dwh_fact_Events','domain_id','event_date_id','dwh_dim_domain','domain_id','1'),
	('dwh_fact_Events','Control_id','event_date_id','dwh_dim_Control','control_id','1'),
	('dwh_fact_Events','event_type_id','event_date_id','dwh_dim_event_type','event_type_id','1'),
	('dwh_aggr_partner_daily_usage','partner_id','date_id','dwh_dim_partners','partner_id','1')
;


# andromeda
INSERT INTO kalturadw.`ri_mapping` (`table_name`, `column_name`, `date_id_column_name`, `reference_table`, `reference_column`, `perform_check`) 
	VALUES
	('dwh_dim_Partners','Partner_group_Type_ID','dwh_update_date','dwh_dim_partner_group_type','Partner_group_Type_ID','1')
;
