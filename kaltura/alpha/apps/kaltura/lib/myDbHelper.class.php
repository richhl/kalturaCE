<?php
/**
 * will encapsulate methods for connectiong to more than one DB 
 */
class myDbHelper
{
	const DB_HELPER_CONN_PROPEL2 = "propel2";
	const DB_HELPER_CONN_PROPEL3 = "propel3";
	
	public static $use_alternative_con = null;
	
	public static function alternativeCon ( $con )
	{
		if ( ! self::$use_alternative_con ) return $con;
		if ( $con == null )
		{
			$con = Propel::getConnection ( self::$use_alternative_con);
		}
		return $con;
	}
}
?>