SET @fd:="puserId";
UPDATE dwh_dim_entries 
SET puser_id=
TRIM(LEADING '"' FROM
	SUBSTR(	custom_data,
			LOCATE('s:',custom_data,
					LOCATE(@fld,custom_data))+5,
			LOCATE(';',SUBSTR(custom_data,LOCATE('s:',custom_data,LOCATE(@fld,custom_data))+5))-2
		)
)
WHERE custom_data LIKE CONCAT ("%",@fld,"%")