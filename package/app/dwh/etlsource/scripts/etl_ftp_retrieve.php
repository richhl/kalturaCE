<?php
# This script retrieves FTP files for use via Pentaho. 
# Currently used for FMS processing.
#
# Requires a PHP with Propel installed.

require_once 'propel/Propel.php';

// Check argument variables
if (count($argv) < 12)
{
	echo count($argv) . " parameters found.\n";
	echo "Usage: php etl_ftp_retrieve.php <ftphost> <ftpport> <ftpuser> <ftppass> <ftpwildcard> <write_dir> <dbhost> <dbport> <dbuser> <dbpass> <processid> <prefix>\n";
	exit(2);
}

// Get argument variables
$ftphost = $argv[1];
$ftpport = $argv[2];
$ftpuser = $argv[3];
$ftppassenc = $argv[4];
$ftpwildcard = "/^".$argv[5]."$/";
$write_dir = $argv[6];
$dbhost = $argv[7];
$dbport = $argv[8];
$dbuser = $argv[9];
$dbpassenc = $argv[10];
$processid = $argv[11];
$prefix = ( array_key_exists(12,$argv) ? $argv[12] : '' );
include('BigInteger.php');

# reverses Pentaho's password obfuscation
function decrypt($val)
{
  # Support for both obfuscated and unobfuscated passwords
	$encryptionstr = 'Encrypted ';
	if ( strstr($val,$encryptionstr) )
		$val = substr( $val,strlen($encryptionstr) );
	else
		return $val;
	
	# decryption logic
	$decconst = new Math_BigInteger('933910847463829827159347601486730416058');
	$decrparam = new Math_BigInteger($val,16);
	$decryptedval = $decrparam->bitwise_xor($decconst)->toBytes();
	$result = "";
	for($i=0;$i<strlen($decryptedval);$i=$i+1)
	{
		$result.=$decryptedval[$i];
	}
	return $result;
}

$ftppass = decrypt($ftppassenc); 
$dbpass = decrypt($dbpassenc);
if (!$ftppass or !$dbpass)
{
	echo "Could not determine FTP or DB password.\n";
	exit(1);
}
// Initialization
echo "Downloading to ".$write_dir."\n";

echo "Connecting to FTP...\n";
$ftpconn = ftp_connect( $ftphost, $ftpport );
if ( ! $ftpconn )
{
	echo "could not connect to ftp server ". $ftphost . " on port " . $ftpport . "\n";
	exit(1);
}

$ftp_login = ftp_login($ftpconn,$ftpuser,$ftppass);
if (! $ftp_login )
{
	echo "could not login to ftp server " . $ftphost . " with u/p " . $ftpuser . "/" . $ftppass . "\n";
	exit(1);
}
ftp_pasv($ftpconn,true);

// Get a filtered file list from FTP
echo "Getting file list...";
$file_list=ftp_nlist($ftpconn,'.');
echo "Done\n";
if (!$file_list or count($file_list)==0)
{
	echo "No files to download from FTP.  FTP Directory is empty.\n";
	exit(0);
}

echo "Found ".count($file_list)." files. Filtering by wildcard: ".$ftpwildcard."\n";
$filtered_file_list = preg_grep( $ftpwildcard, $file_list );
if (count($filtered_file_list)==0)
{
	echo "No files to download from FTP.\n";
	exit(0);
}

echo "Found ".count($filtered_file_list)." files\n";
// Get files from MySQL
echo "Getting registered files from mysql for process_id ".$processid.".\n";

// Remove 'split_' prefix and '.##' suffix, if needed
$query='SELECT DISTINCT IF (SUBSTR(file_name,1,6)=\'split_\', SUBSTR(file_name, 7,LENGTH(file_name)-9) ,file_name) FROM kalturadw_ds.files WHERE process_id = '.$processid;

// due to a bug in PDO, 'localhost' for mysql must be changed to '127.0.0.1'
if ( $dbhost == 'localhost' )
{
	$dbhost = '127.0.0.1';
}

$dsn = 'mysql:host='.$dbhost.';dbname=kalturadw_ds;port='.$dbport;
echo "Connecting to database...";
try {
	$dbcon = new PDO($dsn, $dbuser,$dbpass);
} catch ( PDOException $e ) {
    echo "Could not connect to database ".$dbhost."@".$dbport." with u/p ".$dbuser."/".$dbpass."\n";
    echo "DB Connection Error: " . $e->getMessage(). "\n";
    exit(1);
}
echo " querying...";
$files_registered = array();
try {
	foreach ($dbcon->query($query) as $file)
	{
		$files_registered[]='^'.$file[0].'$';
	}
	$dbcon = null;
} catch (PDOException $e) {
    print "DB Query Error: " . $e->getMessage() . "\n";
    exit(1);
}

// disconnect from DB
$con = null;
echo "Done\n";
echo "Found ".count($files_registered)." registered files\n";
if (count($files_registered)>0)
{
	$files_to_retrieve = preg_grep('/('.implode('|',$files_registered).')/',$filtered_file_list,PREG_GREP_INVERT);
}
else
{
	$files_to_retrieve = $filtered_file_list;
}

if (count($files_to_retrieve) == 0)
{
	echo "No new files to download.\n";
	exit(0);
}

echo count($files_to_retrieve)." new files found\nDownloading:\n";
foreach ($files_to_retrieve as $file)
{
	echo $prefix.$file."\n";
	if ( ! ftp_get($ftpconn,$write_dir."/".$prefix."_".$file,$file,FTP_BINARY) ) {
    exit(1);
	}
}

ftp_close($ftpconn);

?>
