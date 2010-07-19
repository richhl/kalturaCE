UPDATE kalturadw.dwh_dim_partners 
set partner_type_id=100 where (partner_type_id=1 or partner_type_id is null) and description like "%wiki%";

UPDATE kalturadw.dwh_dim_partners 
set partner_type_id=101 where (partner_type_id=1 or partner_type_id is null) and description like "wordpress%";

UPDATE kalturadw.dwh_dim_partners 
set partner_type_id=102 where (partner_type_id=1 or partner_type_id is null) and description like "drupal module%";

UPDATE kalturadw.dwh_dim_partners 
set partner_type_id=105 where (partner_type_id=1 or partner_type_id is null) and description like "%ce version%";

# all the others are OTHERS
UPDATE kalturadw.dwh_dim_partners 
set partner_type_id=2 where (partner_type_id=1 or partner_type_id is null) and description NOT like "%kmc_signup%";



