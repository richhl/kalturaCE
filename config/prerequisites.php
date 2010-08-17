<?php

class KalturaPrerequisites
{
	public static $versions = array (
		'php' => array('>=', '5.2.0'),
		'apache' => array('>=', '2.2'),
		'mysql' => array('>=', '5.1.33'),
	);
	
	public static $dirs = array (
		// if neede, can be implemented the same was as $files
	);
	
	public static $files = array (
		'pentaho kitchen.sh' => '/usr/local/pentaho/pdi/kitchen.sh',
	);
	
	public static $databases = array (
		'kaltura', 'kalturadw', 'kalturadw_ds', 'kalturadw_bisources', 'kalturalog', 'kaltura_stats',
	);
	
	public static $bins = array (
		'curl',
		'mysql',
	);
	
	
	public static $php_extensions = array ( 
		'gd',	
		'curl',
		'mysql',
		'mysqli',
		'exif',
		'ftp',
		'iconv',
		'json',
		'session',
		'SPL',
		'dom',
		'SimpleXML',
		'xml',
		'ctype',
	);
	
	
	public static $apache_modules = array (
		'rewrite',
		'headers',
		'expires', 
		'filter',
		'deflate',
		'file_cache',
		'env',
		'proxy',
	);
	

	
	public static $mysql_settings = array (
		'lower_case_table_names' => array ('=', '1'),
		'thread_stack' => array('>=', '262144'),
	
	);
	
}
