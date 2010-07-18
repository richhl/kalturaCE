<?php


class UserInputUtils
{
	
	public static function getTrueFalse($request_text, $default)
	{
		$input = self::getInput($request_text);
		if ((strcasecmp('y',$input) === 0) || strcasecmp('yes',$input) === 0) {
			return true;
		}
		else if (((strcasecmp('n',$input) === 0) || strcasecmp('no',$input) === 0)) {
			return false;
		}
		else {
			return ((strcasecmp('y',$default) === 0) || strcasecmp('yes',$default) === 0);			
		}
	}	
	
	
	public static function getInput($request_text)
	{
		echo $request_text.PHP_EOL.'> ';
  		$input = trim(fgets(STDIN));
  		echo PHP_EOL;
  		return $input;
	}
	
	private static function getFirstWhich($file_name)
	{
		if (!is_array($file_name)) {
			$file_name = array ($file_name);
		}
		foreach ($file_name as $file) {
			$which_path = FileUtils::exec("which $file");
			if (isset($which_path[0]) && trim($which_path[0]) != '') {
				return $which_path[0];
			}
		}
		return null;		
	}
	
	
	public static function getPathInput($request_text, $must_exist, $is_dir, $which_name = null)
	{
		$input_ok = false;
		$which_path = false;
		
		while (!$input_ok) {
			echo $request_text.PHP_EOL;
			
			if ($must_exist && $which_name) {
				$which_path = self::getFirstWhich($which_name);
				if (substr($which_path, 0, 1) != '/') {
					$which_path = false;
				}
				if ($which_path) {
					echo 'Leave empty for ['.$which_path.']'.PHP_EOL;
				}
			}
			echo '> ';
			$input = trim(fgets(STDIN));
			if ($which_path && trim($input) == '') {
				$input = $which_path;
			}
			
			$input = InstallUtils::fixPath($input, '/');
			if (substr($input, 0, 1) != '/') {
				echo PHP_EOL.InstallerTexts::getText('global', 'not_full_path').PHP_EOL;	
			}
			else if ($must_exist) {
				if ($is_dir) {
					if (!is_dir($input)) {
						echo PHP_EOL.InstallerTexts::getText('global', 'path_not_valid').PHP_EOL;
					}
					else {
						$input_ok = true;
					}
				}
				else {
					if (!is_file($input)) {
						echo PHP_EOL.InstallerTexts::getText('global', 'path_not_valid').PHP_EOL;
					}
					else {
						$input_ok = true;
					}
				}
			}
			else {
				$input_ok = true;
			}
		}
		echo PHP_EOL;
		return $input;
	}
	
}