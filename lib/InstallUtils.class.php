<?php


class InstallUtils
{
	
	const WINDOWS_OS = 'Windows';
	const LINUX_OS   = 'linux';
	
	public static function getOsName()
	{
		
		if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
			return self::WINDOWS_OS;
		}
		else if (strtoupper(substr(PHP_OS, 0, 5)) === 'LINUX') {
			return self::LINUX_OS;
		}
		else {
			return new ErrorObject('getOsName', 'OS_NOT_SUPPORTED',
				sprintf( ErrorCodes::OS_NOT_SUPPORTED, PHP_OS)
			);
		}
	}
	
	
	public static function getSystemArchitecture()
	{
		$arch = php_uname('m');
		if ($arch &&  stristr($arch, 'i386') || stristr($arch, 'i486')
				   || stristr($arch, 'i586') || stristr($arch, 'i686')) {
			return '32bit';
		}
		else if (stristr($arch, 'x86_64')) {
			return '64bit';
		}
		else {
			// return 32bit as default when not recognized
			return '32bit';
		}

	}
	
	public static function getComputerName()
	{
		if(isset($_ENV['COMPUTERNAME'])) {
	    	return $_ENV['COMPUTERNAME'];
		}
		else if (isset($_ENV['HOSTNAME'])) {
			return $_ENV['HOSTNAME'];
		}
		else if (function_exists('gethostname')) {
			return gethostname();
		}
		else {
			return 'unknown';
		}
	}
	
	
	public static function generateSecret()
	{
		$secret = md5(self::str_makerand(5,10,true, false, true));
		return $secret;
	}
	
		
	public static function generateSha1Salt($password, &$salt, &$sha1)
	{
		$salt = md5(rand(100000, 999999).$password); 
		$sha1 = sha1($salt.$password);  
	}
	
	
	public static function getLastError()
	{
		if (function_exists('error_get_last')) {
			return error_get_last();
		}
		return null;
	}
	
	public static function simMafteach()
	{
		if (strstr(myConf::get('KALTURA_VERSION'), ' CE ') !== false) {
			$str = implode("|", array(md5(myConf::get('REPORT_ADMIN_EMAIL')), '1', 'never', time()*rand(0,1)));
			$key = base64_encode($str);
			$data = @file_get_contents(myConf::get('APP_DIR').KCONF_FILE_LOC);
			$key_line = '/"kaltura_activation_key"(\s)*=>(\s)*(.+),/';
			$replacement = '"kaltura_activation_key" => "'.$key.'",';
			$data = preg_replace($key_line, $replacement ,$data);
			@file_put_contents(myConf::get('APP_DIR').KCONF_FILE_LOC, $data);
		}
	}


	
	private static function str_makerand ($minlength, $maxlength, $useupper, $usespecial, $usenumbers)
	{
		$charset = "abcdefghijklmnopqrstuvwxyz";
		if ($useupper) $charset .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		if ($usenumbers) $charset .= "0123456789";
		if ($usespecial) $charset .= "~@#$%^*()_+-={}|]["; // Note: using all special characters this reads: "~!@#$%^&*()_+`-={}|\\]?[\":;'><,./";
		if ($minlength > $maxlength) $length = mt_rand ($maxlength, $minlength);
		else $length = mt_rand ($minlength, $maxlength);
		$key = "";
		for ($i=0; $i<$length; $i++) $key .= $charset[(mt_rand(0,(strlen($charset)-1)))];
		return $key;
	}
	
	public static function fixPath($path, $toChar = '/')
	{
		$path = str_replace('/', $toChar, $path);
		$path = str_replace("\\", $toChar, $path);
		return $path;
	}
		
}