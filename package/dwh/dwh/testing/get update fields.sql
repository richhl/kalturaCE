SET SESSION group_concat_max_len = 4000;
SELECT tname, CONCAT
(
'/* Find different or missing rows*/
SELECT ' COLLATE utf8_general_ci,table_field,
' 
FROM kalturadw.',dw_tn ,'
 WHERE (',table_field,')',
' 
NOT IN (SELECT ',stream_field,
'
		FROM kaltura.',o_tn,')
UNION ALL 
 SELECT ',stream_field,
' 
FROM kaltura.',o_tn,'
 WHERE (',stream_field,')
 NOT IN (SELECT ',table_field,
'
		FROM kalturadw.',dw_tn,')
order by ',o_tn,'_id;
'
)
FROM
(
SELECT tname,dw_tn,o_tn,GROUP_CONCAT(IF(v1 = CONCAT(o_tn COLLATE utf8_general_ci,'_id'),v1,
					CONCAT('ifnull(',v1,','''')'))) table_field ,
	GROUP_CONCAT(IF( default_value IS NULL, 
	     IF(v2 = 'id',v2,CONCAT('ifnull(',v2,','''')')),
	     CONCAT('if(',v2,' is null or cast(',v2,' as char)='''',''',default_value,''',',v2,')')) ) stream_field
FROM (
SELECT DISTINCT u1.tname,u1.dw_tn,u1.o_tn,u1.value_str v1,u2.value_str v2,d.default_value
FROM kalturaetl.update_step u2,kalturaetl.update_step u1 LEFT OUTER JOIN kalturadw.ri_defaults d
	ON u1.value_str = d.default_field AND u1.dw_tn = d.table_name
WHERE u1.tname = u2.tname
	AND u1.nr = u2.nr
	AND u1.code IN ( 'value_name','column_name')
	AND u2.code IN ('value_rename','stream_name')
	AND u1.value_str NOT IN 
	('updated_hour_id','updated_date_id','created_hour_id','created_date_id',
	'Partner_Type_Name','Partner_Status_Name','modified_date_id','modified_hour_id',
	'Kuser_Status_Name','country_id','gender_name','location_id','editor_type_id',
	'conversion_quality','storage_size','width','height',
		/*temp for partners - * 'partner_name','description','admin_name', /**/
		/*temp for users - *  'tagline','about_me','full_name','screen_name','date_of_birth','network_college', /**/
		/*temp for widget - *  'partner_data', /**/
		/*temp for entry - * 'tags','entry_name', /**/
		'activity_hour_id','activity_date_id','day_id','hour','','','','','','','','','','','','','')
) a
GROUP BY tname,dw_tn,o_tn	
ORDER BY tname
) a;