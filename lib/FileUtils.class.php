<?php

DEFINE('TOKEN_CHAR', '@');

class FileUtils
{
	/**
	 * File/folder names list to ignore in various functions - check below
	 * @var string[]
	 */
	private static $ignore_list = array ( '.svn' );
	
	/**
	 * @param string $path dir/file path
	 * @return boolean true if the path should be ignored according to $ignore_list, or false otherwise.
	 */
	private static function shouldIgnore($path)
	{
		$base = basename($path);
		return in_array($base, self::$ignore_list);
	}
	
	/**
	 * Copy source to target.
	 * - $path will be ignored if in $ignore_list -
	 * @param string $source source path
	 * @param string $target target path
	 * @param boolean $overwrite true/false - overwrite or not
	 * @return true on success, ErrorObject on error
	 */
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
	
	
	
	/**
	 * Create a new directory
	 * - $path will be ignored if in $ignore_list -
	 * @param string $path directory path to create
	 * @return true on success, ErrorObject on error
	 */
	public static function mkDir($path)
	{
		$path = InstallUtils::fixPath($path);
		if (self::shouldIgnore($path)) {
			return true;
		}
		if (!is_dir($path)) {
			if (!@mkdir($path, 0777, true)) {
				$last_error = InstallUtils::getLastError();
				return new ErrorObject('mkDir', 'CANT_CREATE_DIR', sprintf(ErrorCodes::CANT_CREATE_DIR, $path, $last_error['message']));
			}
		}
		return true;
	}
	
	
	/**
	 * Read directory contents
	 * @param string $path directory path
	 * @return string[] array of directory contents (base name only), or ErrorObject on error
	 */
	public static function readDir($path)
	{
		$path = InstallUtils::fixPath($path);
		if (self::shouldIgnore($path)) {
			return true;
		}
		if (!is_dir($path)) {
			return new ErrorObject ('readDir', 'PATH_NOT_FOUND', sprintf(ErrorCodes::PATH_NOT_FOUND, $path));
		}
		
		$temp_contents = @scandir($path);
		if (!$temp_contents) {
			return new ErrorObject ('readDir', 'CANT_READ_DIR', sprintf(ErrorCodes::CANT_READ_DIR, $path, InstallUtils::getLastError()));
		}
		$contents = array();
		foreach ($temp_contents as $item) {
			if ($item != '.' && $item != '..' && !self::shouldIgnore($item)) {
				$contents[] = $item;
			}
		}
		return $contents;
	}
	
	
		
	/**
	 * Completely delete the given path
	 * @param string $path path to delete
	 * @return true on success, ErrorObject on error
	 */
	public static function recursiveDelete($path)
	{
		$result = true;
		$path = InstallUtils::fixPath($path, '/');
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
    
    
    /**
     * Replace tokens in all files in given directory path, recursively
     * @param string[] $tokens array of key=>value replacements
     * @param string $path directory path
     * @return true on success, ErrorObject on error
     */
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
    
    
    /**
     * Write $data to $filename
     * @param string $filename file name to write to
     * @param string $data data to write
     */
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
    
    
    /**
     * Replace tokens in given file
     * @param string[] $tokens array of key=>value replacements
     * @param string $file file path
     * @return true on success, ErrorObject on error
     */
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
	
	
	/**
	 * Chmod given $path to $chmod
	 * @param string $path directory/file path
	 * @param string $chmod
	 * @return true on success, ErrorObject on error
	 */
	public static function chmod ($path, $chmod)
	{
		$result = @exec("chmod $chmod $path");
		if (trim($result) !== '') {
			return new ErrorObject('chmod', 'CANT_CHANGE_MODE', sprintf(ErrorCodes::CANT_CHANGE_MODE, $path, $result));
		}
		return true;
	}
	
	/**
	 * Change owner of given $path to $user
	 * @param string $path
	 * @param string $user user name
	 * @return true on success, ErrorObject on error
	 */
	public static function chown ($path, $user)
	{
		$result = @exec("chown -R $user $path");
		if (trim($result) !== '') {
			return new ErrorObject('chown', 'CANT_CHANGE_OWNER', sprintf(ErrorCodes::CANT_CHANGE_OWNER, $path, $result));
		}
		return true;
	}
	
	/**
	 * Execute the given command, returning the output
	 * @param string $cmd command to execute
	 */
	public static function exec($cmd)
	{
		// 2>&1 is needed so the output will not display on the screen
		@exec($cmd . ' 2>&1', $output);
		return $output;
	}
	
	/**
	 * Execute the given command as the given user.
	 * @param string $cmd command to execute
	 * @param string $user username
	 */
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