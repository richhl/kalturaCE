SELECT m.table_name,m.column_name
FROM kalturadw.ri_mapping m LEFT OUTER JOIN   information_schema.STATISTICS s
	ON m.table_name = s.table_name AND m.column_name = s.column_name
		AND seq_in_index = 1 
WHERE s.table_name IS NULL
UNION
SELECT m.reference_table,m.reference_column
FROM kalturadw.ri_mapping m LEFT OUTER JOIN   information_schema.STATISTICS s
	ON m.reference_table = s.table_name AND m.reference_column = s.column_name
		AND seq_in_index = 1 
WHERE s.table_name IS NULL

