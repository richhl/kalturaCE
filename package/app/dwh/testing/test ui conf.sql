/* Find different or missing rows*/
SELECT IFNULL(ui_conf_type_id,''),IFNULL(use_cdn,''),IFNULL(updated_at,''),IFNULL(tags,''),IFNULL(swf_url,''),IFNULL(UI_Conf_Status_ID,''),IFNULL(subp_id,''),IFNULL(partner_id,''),IFNULL(ui_conf_name,''),ui_conf_id,IFNULL(html_params,''),IFNULL(display_in_search,''),IFNULL(description,''),IFNULL(custom_data,''),IFNULL(created_at,''),IFNULL(conf_vars,''),IFNULL(conf_file_path,'') 
FROM kalturadw.dwh_dim_ui_conf
 WHERE (IFNULL(ui_conf_type_id,''),IFNULL(use_cdn,''),IFNULL(updated_at,''),IFNULL(tags,''),IFNULL(swf_url,''),IFNULL(UI_Conf_Status_ID,''),IFNULL(subp_id,''),IFNULL(partner_id,''),IFNULL(ui_conf_name,''),ui_conf_id,IFNULL(html_params,''),IFNULL(display_in_search,''),IFNULL(description,''),IFNULL(custom_data,''),IFNULL(created_at,''),IFNULL(conf_vars,''),IFNULL(conf_file_path,'')) 
NOT IN (SELECT IF(obj_type IS NULL OR CAST(obj_type AS CHAR)='','-1',obj_type),IFNULL(use_cdn,''),IF(updated_at IS NULL OR CAST(updated_at AS CHAR)='','2099-01-01 00:00:00',updated_at),IFNULL(tags,''),IFNULL(swf_url,''),IF(STATUS IS NULL OR CAST(STATUS AS CHAR)='','-1',STATUS),IF(subp_id IS NULL OR CAST(subp_id AS CHAR)='','-1',subp_id),IF(partner_id IS NULL OR CAST(partner_id AS CHAR)='','-1',partner_id),IFNULL(NAME,''),id,IFNULL(html_params,''),IFNULL(display_in_search,''),IFNULL(description,''),IFNULL(custom_data,''),IF(created_at IS NULL OR CAST(created_at AS CHAR)='','2099-01-01 00:00:00',created_at),IFNULL(conf_vars,''),IFNULL(conf_file_path,'')
		FROM kaltura.ui_conf)
UNION ALL 
 SELECT IF(obj_type IS NULL OR CAST(obj_type AS CHAR)='','-1',obj_type),IFNULL(use_cdn,''),IF(updated_at IS NULL OR CAST(updated_at AS CHAR)='','2099-01-01 00:00:00',updated_at),IFNULL(tags,''),IFNULL(swf_url,''),IF(STATUS IS NULL OR CAST(STATUS AS CHAR)='','-1',STATUS),IF(subp_id IS NULL OR CAST(subp_id AS CHAR)='','-1',subp_id),IF(partner_id IS NULL OR CAST(partner_id AS CHAR)='','-1',partner_id),IFNULL(NAME,''),id,IFNULL(html_params,''),IFNULL(display_in_search,''),IFNULL(description,''),IFNULL(custom_data,''),IF(created_at IS NULL OR CAST(created_at AS CHAR)='','2099-01-01 00:00:00',created_at),IFNULL(conf_vars,''),IFNULL(conf_file_path,'') 
FROM kaltura.ui_conf
 WHERE (IF(obj_type IS NULL OR CAST(obj_type AS CHAR)='','-1',obj_type),IFNULL(use_cdn,''),IF(updated_at IS NULL OR CAST(updated_at AS CHAR)='','2099-01-01 00:00:00',updated_at),IFNULL(tags,''),IFNULL(swf_url,''),IF(STATUS IS NULL OR CAST(STATUS AS CHAR)='','-1',STATUS),IF(subp_id IS NULL OR CAST(subp_id AS CHAR)='','-1',subp_id),IF(partner_id IS NULL OR CAST(partner_id AS CHAR)='','-1',partner_id),IFNULL(NAME,''),id,IFNULL(html_params,''),IFNULL(display_in_search,''),IFNULL(description,''),IFNULL(custom_data,''),IF(created_at IS NULL OR CAST(created_at AS CHAR)='','2099-01-01 00:00:00',created_at),IFNULL(conf_vars,''),IFNULL(conf_file_path,''))
 NOT IN (SELECT IFNULL(ui_conf_type_id,''),IFNULL(use_cdn,''),IFNULL(updated_at,''),IFNULL(tags,''),IFNULL(swf_url,''),IFNULL(UI_Conf_Status_ID,''),IFNULL(subp_id,''),IFNULL(partner_id,''),IFNULL(ui_conf_name,''),ui_conf_id,IFNULL(html_params,''),IFNULL(display_in_search,''),IFNULL(description,''),IFNULL(custom_data,''),IFNULL(created_at,''),IFNULL(conf_vars,''),IFNULL(conf_file_path,'')
		FROM kalturadw.dwh_dim_ui_conf)
ORDER BY ui_conf_id;
