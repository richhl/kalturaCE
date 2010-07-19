<?php

DEFINE('TOKEN_CHAR', '@');

class FileUtils
{
	
	private static $ignore_list = array ( '.svn' );
	
	
	private static function shouldIgnore($path)
	{
		$base = basename($path);
		return in_array($base, self::$ignore_list);
	}
	
	public static function fullCopy($source, $target, $overwrite = false)
	{
		$source = InstallUtils::fixPath($source);
		$target = InstallUtils::fixPath($target);
		$result = true;
		if (self::shouldIgnore($source)) {
			return true;
		}
		if (is_file($source)) {
			if (!is_dir(dirname($target))) {
				self::mkDir(dirname($target));
			}
			if (!@copy( $source, $target )) {
				$last_error = InstallUtils::getLastError();
				return new ErrorObject('fullCopy', 'CANT_COPY_FILE', sprintf(ErrorCodes::CANT_COPY_FILE, $source, $target, $last_error['message']));
			}
		}
		else if (is_dir($source)) {
			self::mkDir($target);
			$d = @dir($source);
			if (!$d) {
				$last_error = InstallUtils::getLastError();
				return new ErrorObject('fullCopy', 'CANT_READ_DIR', sprintf(ErrorCodes::CANT_READ_DIR, $source, $last_error['message']));
			}
			while (($result === true) && ($entry = $d->read()) !== FALSE)
			{
				if ( $entry != '.' && $entry != '..' )
				{		
					$Entry = $source . DIRECTORY_SEPARATOR . $entry; 
					$result = self::fullCopy( $Entry, $target . DIRECTORY_SEPARATOR . $entry, $overwrite);
				}
			}
			$d->close();
		}
		else {
			return new ErrorObject('fullCopy', 'PATH_NOT_FOUND', sprintf(ErrorCodes::PATH_NOT_FOUND, $source));
		}

		return $result;
	}
	
	
	
	
	public static function mkDir($path)
	{
		$path = InstallUtils::fixPath($path);
		if (self::shouldIgnore($path)) {
			return true;
		}
		if (!is_dir($path)) {
			if (!@mkdir($path, '0777', true)) {
				$last_error = InstallUtils::getLastError();
				return new ErrorObject('mkDir', 'CANT_CREATE_DIR', sprintf(ErrorCodes::CANT_CREATE_DIR, $path, $last_error['message']));
			}
		}
		return true;
	}
	
	
		
	
	public static function recursiveDelete($path)
	{
		$result = true;
		$path = InstallUtils::fixPath($path, '/');
		if (self::shouldIgnore($path)) {
			return true;
		}
		$onlyContents = (substr($path, strlen($path) - 2) == '/*');
		if ($onlyContents) {
			$path = substr($path, 0, strlen($path)-2);
		}
		if (is_file($path)){
            if (!@unlink($path)) {
            	$last_error = InstallUtils::getLastError();
            	return new ErrorObject('recursiveDelete', 'CANT_DELETE_FILE', sprintf(ErrorCodes::CANT_DELETE_FILE, $path, $last_error['message']));
            }
        }
        else if (is_dir($path) || $onlyContents){
            $scan = @scandir($path);
            if ($scan === false) {
            	$last_error = InstallUtils::getLastError();
            	return new ErrorObject('recursiveDelete', 'CANT_READ_DIR', sprintf(ErrorCodes::CANT_READ_DIR, $path, $last_error['message']));
            }
            foreach($scan as $index => $cur){
            	if ($cur != '.' && $cur != '..') {
	                $result = self::recursiveDelete($path.'/'.$cur);
	                if ($result !== true) {
	                	return $result;
	                }
            	}
            }
            
            if (!$onlyContents && !@rmdir($path)) {
            	$last_error = InstallUtils::getLastError();
            	return new ErrorObject('recursiveDelete', 'CANT_DELETE_DIR', sprintf(ErrorCodes::CANT_DELETE_DIR, $path, $last_error['message']));
            }
        }
        
        return $result;
    }
    
    
    
    public static function replaceTokens($tokens, $path)
    {
    	$path = InstallUtils::fixPath($path);
        if (self::shouldIgnore($path)) {
			return true;
		}
    	if (is_file($path)) {
    		return self::replaceTokensInFile($tokens, $path);
    	}
    	else if (is_dir($path)) {
    		$list = @scandir($path);
    		if (!$list) {
    			$last_error = InstallUtils::getLastError();
    			return new ErrorObject('replaceTokens', 'CANT_READ_DIR', sprintf(ErrorCodes::CANT_READ_DIR, $path, $last_error['message']));
    		}
    		foreach ($list as $item) {
    			if ($item !== '.' && $item !== '..') {
    				$item = $path.DIRECTORY_SEPARATOR.$item;
    				$result = self::replaceTokens($tokens, $item);
    				if ($result !== true) {
    					return $result;
    				}
    			}
    		}
    	}
    	else {
    		return new ErrorObject('replaceTokens', 'PATH_NOT_FOUND', sprintf(ErrorCodes::PATH_NOT_FOUND, $source));
    	}
    	
    	return true;
    }
    
    
    public static function writeFile($filename, $data)
    {
    	$dir_name = dirname($filename);
    	if (!is_dir($dir_name)) {
    		$proceed = self::mkDir($dir_name);
    		if ($proceed !== true) {
    			return $proceed;
    		}
    	}
    	
    	$fh = fopen($filename, 'w');
		if (!$fh) {
			$last_error = InstallUtils::getLastError();
			return new ErrorObject('writeFile', 'CANT_CREATE_FILE', sprintf(ErrorCodes::CANT_CREATE_FILE, $filename, $last_error['message']));
		}
		if (!fwrite($fh, $data)) {
			$last_error = InstallUtils::getLastError();
			return new ErrorObject('writeFile', 'CANT_WRITE_TO_FILE', sprintf(ErrorCodes::CANT_WRITE_TO_FILE, $filename, $last_error['message']), $data);
		}
		fclose($fh);
		return true;
    }
    
    
	private static function replaceTokensInFile(&$tokens, $file)
	{
		$file = InstallUtils::fixPath($file);
		$data = @file_get_contents($file);
		if (!$data) {
			$last_error = InstallUtils::getLastError();
			return new ErrorObject('replaceTokensInFile', 'CANT_READ_FILE', sprintf(ErrorCodes::CANT_READ_FILE, $file, $last_error['message']));
		}
		else {
			foreach ($tokens as $key => $var) {
				$key = TOKEN_CHAR.$key.TOKEN_CHAR;
				$data = str_replace($key, $var, $data);		
			}
			if (!file_put_contents($file, $data)) {
				$last_error = InstallUtils::getLastError();
				return new ErrorObject('replaceTokensInFile', 'CANT_WRITE_TO_FILE', sprintf(ErrorCodes::CANT_WRITE_TO_FILE, $file, $last_error['message']));
			}
		}
		return true;
	}
	
	public static function chmod ($path, $chmod)
	{
		$result = @exec("chmod $chmod $path");
		if (trim($result) !== '') {
			return new ErrorObject('chmod', 'CANT_CHANGE_MODE', sprintf(ErrorCodes::CANT_CHANGE_MODE, $path, $result));
		}
		return true;
	}
	
	public static function chown ($path, $user)
	{
		$result = @exec("chown -R $user $path");
		if (trim($result) !== '') {
			return new ErrorObject('chown', 'CANT_CHANGE_OWNER', sprintf(ErrorCodes::CANT_CHANGE_OWNER, $path, $result));
		}
		return true;
	}
	
	public static function exec($cmd)
	{
		@exec($cmd . ' 2>&1', $output);
		return $output;
	}
	
	
	public static function execAsUser($cmd, $user)
	{
		$cmd = "sudo -u $user ".$cmd;
		@exec($cmd . ' 2>&1', $output, $result);
		if ($result == 0) {
			return true;
		}
		else {
			return new ErrorObject('execAsUser', 'CANT_EXECUTE', sprintf(ErrorCodes::CANT_CHANGE_OWNER, $cmd, $user), $output);
		}
	} 
	
			
}