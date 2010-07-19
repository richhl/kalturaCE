SELECT *
FROM
(
SELECT u.kuser_id,u.kuser_status_name,u.kuser_status_id,
	(SELECT user_status_name 
	 FROM kalturadw.dwh_dim_user_status ps
	 WHERE u.kuser_status_id = ps.user_status_id) lookup_us
FROM kalturadw.dwh_dim_kusers u
) a
WHERE kuser_status_name <> lookup_us