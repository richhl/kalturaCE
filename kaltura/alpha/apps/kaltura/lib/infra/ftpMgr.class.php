<?php
class ftpMgr
{
	const FTPMGR_RES_OK = 1;
	const FTPMGR_RES_PUT_ERR = -1;
	
	private $conn_id;

	public function login ( $ftp_server , $ftp_user, $ftp_pass , $ftp_passive_mode = TRUE )
	{
		$this->conn_id = ftp_connect($ftp_server);
		if ( ! $this->conn_id  )
			throw new Exception ( "Couldn't connect to $ftp_server"); 
		if (!ftp_login($this->conn_id , $ftp_user, $ftp_pass))
			throw new Exception ( "Couldn't connect as $ftp_user" ); 
		ftp_pasv( $this->conn_id , $ftp_passive_mode );
	}
	
	public function putFile (  $remote_file ,  $local_file ,  $mode )
	{
		$res = ftp_put ( $this->conn_id ,  $remote_file ,  $local_file ,  $mode  );
		if ( ! $res ) return self::FTPMGR_RES_PUT_ERR;
		return self::FTPMGR_RES_OK;
	}
	
	public function getConnection ()
	{
		return $this->conn_id;
	}
	
	public function __destruct( )
	{
		// close the connection
		ftp_close($this->conn_id); 
	}
}
?>