SET @modVal := 1000, @fld='editor_type';
SELECT entry_id, 	
	height, 
	width, 
	conversion_quality, 
	storage_size, 
	editor_type_id, 	
	custom_data
FROM kalturadw.dwh_dim_entries entries
WHERE int_id%@modVal = 0
	AND custom_data LIKE CONCAT('%',@fld,'%')
#	AND (width <> SUBSTR(custom_data,LOCATE(':',custom_data,LOCATE(@fld,custom_data))+1,LOCATE(';',SUBSTR(custom_data,LOCATE(':',custom_data,LOCATE(@fld,custom_data))+1))-1)
#	     AND width <>SUBSTR(custom_data,LOCATE('s:',custom_data,LOCATE(@fld,custom_data))+5,LOCATE(';',SUBSTR(custom_data,LOCATE('s:',custom_data,LOCATE(@fld,custom_data))+5))-2))
#	AND (height <> SUBSTR(custom_data,LOCATE(':',custom_data,LOCATE(@fld,custom_data))+1,LOCATE(';',SUBSTR(custom_data,LOCATE(':',custom_data,LOCATE(@fld,custom_data))+1))-1)
#	     AND height <>SUBSTR(custom_data,LOCATE('s:',custom_data,LOCATE(@fld,custom_data))+5,LOCATE(';',SUBSTR(custom_data,LOCATE('s:',custom_data,LOCATE(@fld,custom_data))+5))-2))
#	AND (conversion_quality <> SUBSTR(custom_data,LOCATE(':',custom_data,LOCATE(@fld,custom_data))+1,LOCATE(';',SUBSTR(custom_data,LOCATE(':',custom_data,LOCATE(@fld,custom_data))+1))-1)
#	     AND conversion_quality <>SUBSTR(custom_data,LOCATE('s:',custom_data,LOCATE(@fld,custom_data))+5,LOCATE(';',SUBSTR(custom_data,LOCATE('s:',custom_data,LOCATE(@fld,custom_data))+5))-2))
#	AND (storage_size <> SUBSTR(custom_data,LOCATE(':',custom_data,LOCATE(@fld,custom_data))+1,LOCATE(';',SUBSTR(custom_data,LOCATE(':',custom_data,LOCATE(@fld,custom_data))+1))-1)
#	     AND storage_size <>SUBSTR(custom_data,LOCATE('s:',custom_data,LOCATE(@fld,custom_data))+5,LOCATE(';',SUBSTR(custom_data,LOCATE('s:',custom_data,LOCATE(@fld,custom_data))+5))-2))
	AND ((SELECT editor_type_name FROM dwh_dim_editor_type et WHERE et.editor_type_id = entries.editor_type_id) <> SUBSTR(custom_data,LOCATE(':',custom_data,LOCATE(@fld,custom_data))+1,LOCATE(';',SUBSTR(custom_data,LOCATE(':',custom_data,LOCATE(@fld,custom_data))+1))-1)
	     AND (SELECT editor_type_name FROM dwh_dim_editor_type et WHERE et.editor_type_id = entries.editor_type_id) <>SUBSTR(custom_data,LOCATE('s:',custom_data,LOCATE(@fld,custom_data))+5,LOCATE(';',SUBSTR(custom_data,LOCATE('s:',custom_data,LOCATE(@fld,custom_data))+5))-2))