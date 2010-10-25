<?php

require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'kFileTransferMgr.class.php');

/*
 * Extends the 'kFileTransferMgr' class & implements a file transfer manager using the SFTP protocol.
 * For additional comments please look at the 'kFileTransferMgr' class.
 */

class sftpMgr extends kFileTransferMgr
{
	
	private $sftp_id = false;
	
	// instances of this class should be created usign the 'getInstance' of the 'kFileTransferMgr' class
	protected function __construct()
	{
		// do nothing
	}

	
	
	public function getConnection()
	{
		if ($this->sftp_id != null && $this->sftp_id != false) {
			return $this->sftp_id;
		}
		else {
			return $this->connection_id;
		}
	}
	
	private function getSsh2Connection() {
		return $this->connection_id;
	}
	
	private function getSftpConnection() {
		return $this->sftp_id;
	}
	
	/**********************************************************************/
	/* Implementation of abstract functions from class 'kFileTransferMgr' */
	/**********************************************************************/
	
	// sftp connect to server:port
	protected function doConnect($sftp_server, &$sftp_port)
	{
		// try connecting to server
		if (!$sftp_port || $sftp_port == 0) {
                	$sftp_port = 22;
		}
		return ssh2_connect($sftp_server, $sftp_port);
	}
	
	
	// login to an existing connection with given user/pass (ftp_passive_mode is irrelevant)
	protected function doLogin($sftp_user, $sftp_pass, $ftp_passive_mode = TRUE)
	{
		// try to login
		if (ssh2_auth_password($this->getSsh2Connection(), $sftp_user, $sftp_pass)) {
			$this->sftp_id = ssh2_sftp($this->getSsh2Connection());
			return ($this->sftp_id != false && $this->sftp_id != null);
		}
		else {
			return false;
		}
	}
	
	
	// login using a public key
	protected function doLoginPubKey($user, $pubKeyFile, $privKeyFile, $passphrase = null)
	{
		return ssh2_auth_pubkey_file($this->getSsh2Connection(), $user, $pubKeyFile, $privKeyFile, $passphrase);
	}
	
	
	// upload a file to the server (ftp_mode is irrelevant
	protected function doPutFile ($remote_file , $local_file , $ftp_mode)
	{
		$sftp = $this->getSftpConnection();
        $stream = @fopen("ssh2.sftp://$sftp$remote_file", 'w');
        if (!$stream) {
        	return false;
        }
        $data_to_send = @file_get_contents($local_file);
        if ($data_to_send === false) {
        	@fclose($stream);
        	return false;
        }
        if (@fwrite($stream, $data_to_send) === false) {
            @fclose($stream);
        	return false;
		}
        return @fclose($stream);		
	}
	
	
	// download a file from the server (ftp_mode is irrelevant)
	protected function doGetFile ($remote_file, $local_file, $ftp_mode)
	{	
		$sftp = $this->getSftpConnection();
        $stream = @fopen("ssh2.sftp://$sftp$remote_file", 'r');
        if (!$stream) {
        	return false;
        }
        $contents = fread($stream, filesize("ssh2.sftp://$sftp$remote_file"));           
        file_put_contents($local_file, $contents);
        return @fclose($stream);
	}
	
	// create a new directory
	protected function doMkDir ($remote_path)
	{
		return ssh2_sftp_mkdir($this->getSftpConnection(), $remote_path);
	}
	
	// chmod the given remote file
	protected function doChmod ($remote_file, $chmod_code)
	{
		$chmod_cmd = 'chmod ' . $chmod_code . ' ' . $remote_file;
		$exec_output = $this->execCommand($chmod_cmd);
		return (trim($exec_output) == ''); // empty output means the command passed ok
	}
	
	// return true/false according to existence of file on the server
	protected function doFileExists($remote_file)
	{
		$exists_cmd = 'test -e ' . $remote_file . ' && echo EXISTS';
		$exec_output = $this->execCommand($exists_cmd);
		return (trim($exec_output) == 'EXISTS');
	}


        // return the current working directory
	protected function doPwd ()
	{
		$pwd_cmd = 'pwd';
		return $this->execCommand($pwd_cmd);
	}

        // delete a file and return true/false according to success
        protected function doDelFile ($remote_file)
        {
        	return ssh2_sftp_unlink($this->getSftpConnection(), $remote_file); 
        }

         // delete a directory and return true/false according to success
        protected function doDelDir ($remote_path)
        {
            //return ssh2_sftp_rmdir($this->getSftpConnection(), $remote_path);
             $deldir_cmd = 'rm -r ' . $remote_path;
             $exec_output = $this->execCommand($deldir_cmd);
             return (trim($exec_output) == ''); // empty output means the command passed ok
        }
	
	
	// execute the given command on the server
	private function execCommand($command_str)
	{
		$stream = ssh2_exec($this->getSsh2Connection(), $command_str, FALSE);
  		stream_set_blocking($stream, true);
   		$output = stream_get_contents($stream);
   		fclose($stream);
   		return $output;
	}
	
}
?>