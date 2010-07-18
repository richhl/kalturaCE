/*run this query, copy the result and execute it*/
SELECT 	CONCAT(
'insert into kalturadw_bisources.bisources_',table_name,'
values( -999 ,''val_999'');
insert into kalturadw_bisources.bisources_',table_name,'
values( -998 ,''val_998'');
')
FROM kalturadw.bisources_tables ;

/*now run the refresh_bi_sources_job*/

/*run this query, copy the result and execute it to test the result*/
SELECT 	CONCAT('select ''',table_name,''',(select count(*)
from
(
select ',table_name,'_id,',table_name,'_name
from kalturadw.dwh_dim_',table_name,'
where (',table_name,'_id,',table_name,'_name)
	not in (SELECT ',table_name,'_id,',table_name,'_name
		FROM kalturadw_bisources.bisources_',table_name,')
union all
SELECT ',table_name,'_id,',table_name,'_name
FROM kalturadw_bisources.bisources_',table_name,'
WHERE (',table_name,'_id,',table_name,'_name)
	NOT IN (SELECT ',table_name,'_id,',table_name,'_name
		FROM kalturadw.dwh_dim_',table_name,')
) a) as c union all') q
FROM kalturadw.bisources_tables
UNION ALL SELECT 'select '''','''';';

/*run this query, copy the result and execute it*/
SELECT 	CONCAT('update kalturadw_bisources.bisources_',table_name,'
set ',table_name,'_name = ''upd_999'' 
where ',table_name,'_id = -999;')
FROM kalturadw.bisources_tables ;
	
/*now run the refresh_bi_sources_job*/

/* now run the test from before again */


/* clean up*/

SELECT 	CONCAT(
'delete from  kalturadw_bisources.bisources_',table_name,'
where ',table_name,'_id in (-999,-998);')dwh_dim_widget_security_type
FROM kalturadw.bisources_tables 
UNION ALL
SELECT 	CONCAT(
'delete from  kalturadw.dwh_dim_',table_name,'
where ',table_name,'_id in (-999,-998);')
FROM kalturadw.bisources_tables ;
