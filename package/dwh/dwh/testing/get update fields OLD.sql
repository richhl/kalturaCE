SET SESSION group_concat_max_len = 4009;
SELECT tname, CONCAT
(
'/* Find different or missing rows*/
SELECT ',table_field,
' 
FROM kalturadw.tn
 WHERE (',table_field,')',
' 
NOT IN (SELECT ',stream_field,
'
		FROM kaltura.stn)
UNION ALL 
 SELECT ',stream_field,
' 
FROM kaltura.stn
 WHERE (',stream_field,')
 NOT IN (SELECT ',table_field,
'
		FROM kalturadw.tn);
'
)
FROM
(
SELECT tname,GROUP_CONCAT(v1) table_field ,
	GROUP_CONCAT(IF( default_value IS NULL, 
	     v2,
	     CONCAT('ifnull(',v2,',''',default_value,''')')) ) stream_field
FROM (
SELECT DISTINCT u1.tname,u1.value_str v1,u2.value_str v2,d.default_value
FROM kalturaetl.update_step u2,kalturaetl.update_step u1 LEFT OUTER JOIN kalturadw.ri_defaults d
	ON u1.value_str = d.default_field AND d.table_name = 
		CASE WHEN u1.tname  = 'Update entries' THEN 'dwh_dim_entries' 
	    WHEN u1.tname  = 'Update Kusers' THEN 'dwh_dim_kusers' 
	    WHEN u1.tname  = 'Update Partners' THEN 'dwh_dim_partners' 
	    WHEN u1.tname  = 'Update UI Conf' THEN 'dwh_dim_ui_conf' 
	    WHEN u1.tname  = 'Update widget' THEN 'dwh_dim_widget'  END 
WHERE u1.tname = u2.tname
	AND u1.nr = u2.nr
	AND u1.code = 'value_name'
	AND u2.code = 'value_rename'
	AND u1.value_str NOT IN 
	('updated_hour_id','updated_date_id','created_hour_id','created_date_id',
	'Partner_Type_Name','Partner_Status_Name','modified_date_id','modified_hour_id',
	'Kuser_Status_Name','country_id','gender_name','location_id','editor_type_id',
	'conversion_quality','storage_size','width','height','','','','','','')
) a
GROUP BY tname	
ORDER BY tname
) a;