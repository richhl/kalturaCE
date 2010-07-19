SELECT *
FROM
(
SELECT p.partner_id,p.partner_type_name,p.partner_type_id,
	(SELECT partner_type_name 
	 FROM kalturadw.dwh_dim_partner_type pt
	 WHERE p.partner_type_id = pt.partner_type_id) lookup_pt,
	p.partner_status_name,p.partner_status_id,
	(SELECT partner_status_name 
	 FROM kalturadw.dwh_dim_partner_status ps
	 WHERE p.partner_status_id = ps.partner_status_id) lookup_ps
FROM kalturadw.dwh_dim_partners p
) a
WHERE partner_type_name <> lookup_pt
	OR partner_status_name <> lookup_ps