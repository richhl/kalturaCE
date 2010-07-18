<?php



class DatabaseUtils
{
	
	public static function connect(&$link, $host, $user, $pass, $db, $port)
	{
		if (trim($pass) == '') {
			$pass = null;
		}
		$link = @mysqli_init();
		$result = @mysqli_real_connect($link, $host, $user, $pass, $db, $port);
		if (!$result) {
		    return new ErrorObject('connect', 'CANT_CONNECT_DB', sprintf(ErrorCodes::CANT_CONNECT_DB, $host, $user, $link->error));
		}
		return true;
	}
	
	
	public static function executeQuery($query, $host, $user, $pass, $db, $port, $link = null)
	{
		if (!$link) {
			$result = self::connect($link, $host, $user, $pass, $db, $port);
			if ($result !== true) {
			    return $result;
			}
		}
		else {
			if (!mysqli_select_db($link, $db)) {
				return new ErrorObject('executeQuery', 'CANT_FIND_DB', sprintf(ErrorCodes::CANT_FIND_DB, $db));
			}
		}
		
		if (!mysqli_multi_query($link, $query) || $link->error != '') {
		    return new ErrorObject('executeQuery', 'ERROR_WITH_SQL_QUERY', sprintf(ErrorCodes::ERROR_WITH_SQL_QUERY, $host, $user, $link->error), $query);
		}
		while (mysqli_next_result($link)) {
			$discard = mysqli_store_result($link);
		}
		$link->commit();
		
		return true;
	}
	
	
	
	public static function createDb($db, $host, $user, $pass, $port)
	{
		$create_db_query = "CREATE DATABASE $db;";
		return self::executeQuery($create_db_query, $host, $user, $pass, null, $port);
	}
	
	
	
	public static function dropDb($db, $host, $user, $pass, $port)
	{
		$drop_db_query = "DROP DATABASE $db;";
		return self::executeQuery($drop_db_query, $host, $user, $pass, null, $port);
	}
	
	
	
	public static function dbExists($db, $host, $user, $pass, $port)
	{
		if ($host == 'localhost') {
			$host = '127.0.0.1';
		}
		$result = self::connect($link, $host, $user, $pass, null, $port);
		if ($result !== true) {
			return $result;
		}
		return mysqli_select_db($link, $db);
	}
		
	
		
	public static function runScript($file, $host, $user, $pass, $db, $port)
	{
		$file = InstallUtils::fixPath($file);
		if (!is_file($file)) {
			return new ErrorObject('runScript', 'PATH_NOT_FOUND', sprintf(ErrorCodes::PATH_NOT_FOUND, $file));
		}
		
		$data = trim(file_get_contents($file));
		if (!$data) {
			return new ErrorObject('runScript', 'CANT_READ_FILE', sprintf(ErrorCodes::CANT_READ_FILE, $file));
		}
		
		return self::executeQuery($data, $host, $user, $pass, $db, $port);

		
		/*
		$mysql_bin = myConf::get('mysql_bin');
		$result = exec("$mysql_bin -u$user -p$pass $db_name < $file", $output);
		if ($result != '') {
			return new ErrorObject('runScript', 'ERROR_WITH_SQL_SCRIPT', sprintf(ErrorCodes::ERROR_WITH_SQL_SCRIPT, $file, $db_name, $user, $result), $output);
		}
		return true;
		*/
	}
			
		
}
