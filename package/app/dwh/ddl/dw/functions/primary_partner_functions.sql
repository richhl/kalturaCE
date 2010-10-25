DELIMITER $$

# ------------- is_primary_partner -------------
DROP FUNCTION IF EXISTS `kalturadw`.`is_primary_partner`$$

CREATE DEFINER=`etl`@`%` FUNCTION `kalturadw`.`is_primary_partner`(partner_id INT(11)) 
	RETURNS INT DETERMINISTIC
BEGIN
	RETURN kalturadw.calc_primary_partner(partner_id,'is_primary');
END$$

DELIMITER ;


# ------------- get_primary_partner -------------
DELIMITER $$
DROP FUNCTION IF EXISTS `kalturadw`.`get_primary_partner`$$

CREATE DEFINER=`etl`@`%` FUNCTION `kalturadw`.`get_primary_partner`(partner_id INT(11)) 
	RETURNS INT DETERMINISTIC
BEGIN
	RETURN kalturadw.calc_primary_partner(partner_id,'get_primary');
END$$

DELIMITER ;


# ------------- calc_primary_partner -------------
DELIMITER $$
DROP FUNCTION IF EXISTS `kalturadw`.`calc_primary_partner`$$

CREATE DEFINER=`etl`@`%` FUNCTION `kalturadw`.`calc_primary_partner`(partner_id INT(11),method_type VARCHAR(11)) 
	RETURNS INT DETERMINISTIC
BEGIN
	DECLARE _partner_alias INT(11);
	DECLARE _primary_partner INT(11);
	DECLARE _is_primary_partner TINYINT;

	SELECT 
		primary_partner,
		partner_alias pid
	INTO _primary_partner,_partner_alias
	FROM 
		dwh_dim_partner_aliases
	WHERE
		partner_alias=partner_id;
		
	IF  _primary_partner IS NULL THEN
		SET _primary_partner=partner_id;
		SET _is_primary_partner=1;
	ELSEIF _primary_partner=partner_id THEN
		SET _primary_partner=partner_id;
		SET _is_primary_partner=1;
	ELSE
		SET _is_primary_partner=0;
	END IF;
	
	IF method_type='is_primary'	THEN RETURN _is_primary_partner;
	ELSEIF method_type='get_primary' THEN RETURN _primary_partner;
	RETURN NULL;
	END IF;
    END$$

DELIMITER ;



# ------------- get_secondary_partners -------------
DELIMITER $$
DROP FUNCTION IF EXISTS `kalturadw`.`get_secondary_partners_as_string`$$

CREATE DEFINER=`etl`@`%` FUNCTION `kalturadw`.`get_secondary_partners_as_string`(partner_id INT(11)) 
	RETURNS VARCHAR(1024) DETERMINISTIC
BEGIN
	DECLARE secondary_partners VARCHAR(1024);
	 
	SELECT GROUP_CONCAT(partner_alias  SEPARATOR " , " )
	INTO  secondary_partners
	FROM dwh_dim_partner_aliases 
	WHERE primary_partner =partner_id
	GROUP BY primary_partner;
		
	IF secondary_partners IS NULL THEN
		SET secondary_partners = "";
	END IF;
	RETURN secondary_partners;
END$$

DELIMITER ;
