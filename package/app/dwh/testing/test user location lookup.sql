
SELECT 	*	
	FROM 
	kaltura.kuser  ku, 
	kalturadw.dwh_dim_kusers  kudw,
	kalturadw.dwh_dim_locations l1,
	kalturadw.dwh_dim_locations l2
	WHERE ku.id = kudw.kuser_id
		AND kudw.location_id = l1.location_id
		AND  kudw.country_id = l2.location_id
		AND (ku.country <> l2.location_name
			OR ku.country <> l1.country
			OR ku.state <> l1.state
			OR ku.city <> l1.city)
