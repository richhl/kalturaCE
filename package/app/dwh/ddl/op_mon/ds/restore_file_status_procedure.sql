DELIMITER $$

DROP PROCEDURE IF EXISTS `kaltura_op_mon`.`restore_file_status`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE kaltura_op_mon.`restore_file_status`(
	pfile_id INT(20)
    )
BEGIN
	UPDATE kaltura_op_mon.files f
	SET f.file_status = f.prev_status,
	    f.prev_status = f.file_status
	WHERE f.file_id = pfile_id;
    END$$

DELIMITER ;