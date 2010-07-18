<?php


class ServerInstallStep extends InstallStep
{

	public function install()
	{
		// copy app dir
		$result = FileUtils::fullCopy(PACKAGE_DIR.PACKAGE_APP, myConf::get('APP_DIR'), true);
		
		// copy web dir
		if ($result === true) { $result = FileUtils::fullCopy(PACKAGE_DIR.PACKAGE_WEB, myConf::get('WEB_DIR'), true); }
		
		// replace tokens in config files
		$tmp_server_config_dir = TMP_DIR.'/server/'.PACKAGE_SERVER_CONFIG;
		if ($result === true) { $result = FileUtils::recursiveDelete($tmp_server_config_dir); }
		if ($result === true) { $result = FileUtils::fullCopy(PACKAGE_DIR.PACKAGE_SERVER_CONFIG, $tmp_server_config_dir); }
		if ($result === true) { $result = FileUtils::replaceTokens(myConf::getAll(), $tmp_server_config_dir); }
		
		// copy config files (after tokens were replaced)		
		if ($result === true) { $result = FileUtils::fullCopy($tmp_server_config_dir, myConf::get('APP_DIR'), true); }
			
		// create directories
		if ($result === true) { $result = $this->mkDirs(); }
		
		// copy binary files
		if ($result === true) { $result = $this->copyBinFiles(); }
		
		// chmod
		if ($result === true) { $result = $this->chmod();	}
		
		if ($result !== true) {
			$this->addStepToError($result);
		}
		return $result;
	}
	
	
	private function chmod()
	{
		$result = FileUtils::chmod(myConf::get('BASE_DIR'), '+r -R');
		if ($result === true) { $result = FileUtils::chmod(myConf::get('WEB_DIR'), '777 -R'); }
		if ($result === true) { $result = FileUtils::chmod(myConf::get('BIN_DIR'), '775 -R'); }
		if ($result === true) { $result = FileUtils::chmod(myConf::get('TMP_DIR'), '777 -R'); }
		if ($result === true) { $result = FileUtils::chmod(myConf::get('LOG_DIR'), '777 -R'); }
		if ($result === true) { $result = FileUtils::chmod(myConf::get('APP_DIR'), '775 -R'); }
		if ($result === true) { $result = FileUtils::chmod(myConf::get('APP_DIR').'scripts/', '775 -R'); }
		if ($result === true) { $result = FileUtils::chmod(myConf::get('APP_DIR').'/cache/', '777 -R'); }
		if ($result === true) { $result = FileUtils::chmod(myConf::get('APP_DIR').'/api_v3/cache/', '777 -R'); }
		if ($result === true) { $result = FileUtils::chmod(myConf::get('APP_DIR').'/alpha/cache/', '777 -R'); }
		if ($result === true) { $result = FileUtils::chmod(myConf::get('APP_DIR').'/batch/cache/', '777 -R'); }
		if ($result === true) { $result = FileUtils::chmod(myConf::get('APP_DIR').'/generator/cache/', '777 -R'); }
		if ($result === true) { $result = FileUtils::chmod(myConf::get('APP_DIR').'/alpha/config/kConf.php', '777'); }
		
		return $result;
	}
	
	private function mkDirs()
	{
		$result = FileUtils::mkDir(myConf::get('LOG_DIR'));
		if ($result === true) { FileUtils::mkDir(myConf::get('LOG_DIR').DIRECTORY_SEPARATOR.'batch'); }
		if ($result === true) { FileUtils::mkDir(myConf::get('LOG_DIR').DIRECTORY_SEPARATOR.'dwh'); }
		if ($result === true) { FileUtils::mkDir(myConf::get('BIN_DIR')); }
		if ($result === true) { FileUtils::mkDir(myConf::get('TMP_DIR')); }
		if ($result === true) { FileUtils::mkDir(myConf::get('APP_DIR').DIRECTORY_SEPARATOR.'cache'); }
		if ($result === true) { FileUtils::mkDir(myConf::get('WEB_DIR').DIRECTORY_SEPARATOR.'tmp'.DIRECTORY_SEPARATOR.'convert'); }
		if ($result === true) { FileUtils::mkDir(myConf::get('WEB_DIR').DIRECTORY_SEPARATOR.'tmp'.DIRECTORY_SEPARATOR.'imports'); }
		if ($result === true) { FileUtils::mkDir(myConf::get('WEB_DIR').DIRECTORY_SEPARATOR.'tmp'.DIRECTORY_SEPARATOR.'thumb'); }
		return $result;
	}
	
		
	private function copyBinFiles()
	{
		$os_name = 	InstallUtils::getOsName();
		$architecture = InstallUtils::getSystemArchitecture();
		
		if (ErrorObject::isErrorObject($os_name)) {
			return $os_name; //error
		}

		if (ErrorObject::isErrorObject($architecture)) {
			return $architecture; //error	
		}
		
		$bin_subdir = $os_name.DIRECTORY_SEPARATOR.$architecture;
		$result = FileUtils::fullCopy(PACKAGE_DIR.PACKAGE_BIN.$bin_subdir, myConf::get('BIN_DIR'), true);

		if ($os_name == InstallUtils::LINUX_OS) {
			
			if ($result === true) { $result = FileUtils::replaceTokens(myConf::getAll(), myConf::get('BIN_DIR').'run/'); }
			symlink(myConf::get('BIN_DIR').'run/run-ffmpeg.sh', myConf::get('BIN_DIR').'ffmpeg');
			symlink(myConf::get('BIN_DIR').'run/run-mencoder.sh', myConf::get('BIN_DIR').'mencoder');
			symlink(myConf::get('BIN_DIR').'run/run-ffmpeg-aux.sh', myConf::get('BIN_DIR').'ffmpeg-aux');
		}		
		
		if ($result !== true) {
			$this->addStepToError($result);
		}
		return $result;		
	}
	
	
	public function prepareForRetry()
	{
		return true;
	}
			
		
}
