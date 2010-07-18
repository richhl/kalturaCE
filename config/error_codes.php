<?php


class ErrorCodes 
{
	// install
	const STEP_FILE_NOT_FOUND = 'Step file not found for [%1$s]';
	const CANT_INCLUDE_STEP_FILE = 'Cannot include step file [%1$s]';
	const STEP_CLASS_NOT_EXISTS = 'Step class [%1$s] does not exist';
	const CANT_INIT_STEP_CALSS = 'Cannot init new object of step class [%1$s]';

	const INSTALL_START = 'Installation started';
	const INSTALL_SUCCESS = 'Installation completed successfully!';
	const INSTALL_FAILED = 'Installation failed!';
	const USER_STOPPED = 'Installation stopped by user following installation errors';
	const CANT_RETRY = 'Errors occurred  - system cannot retry current step';
	const CANT_SET_CRON_JOBS = 'Error occurred while setting up cron jobs';
	
	const CANT_FIND_MYSQL_VERSIONS = 'mySQL version couldn not be determined';
	const CANT_FIND_MYSQL_SETTING = 'mySQL setting [%1$s] was not found in the my.cnf file';
	const MISSING_PREREQUISITES = 'The following prerequisites were found to be missing : %1$s';
	
	// file realted
	const CANT_CREATE_DIR    = 'Cannot create directory [%1$s] - %2$s';
	const CANT_CREATE_FILE   = 'Cannot create file [%1$s] - %2$s';
	const PATH_NOT_FOUND     = 'Cannot find path [%1$s]';
	const CANT_COPY_FILE     = 'Cannot copy file from [%1$s] to [%2$s] - %3$s';
	const CANT_DELETE_FILE   = 'Cannot delete file [%1$s] - %2$s';
	const CANT_DELETE_DIR    = 'Cannot delete file [%1$s] - %2$s';
	const CANT_READ_FILE     = 'Cannot read from file [%1$s] - %2$s';
	const CANT_READ_DIR      = 'Cannot read directory content for [%1$s] - %2$s';
	const CANT_WRITE_TO_FILE = 'Cannot write data to file [%1$s] - %2$s';
	const CANT_CHANGE_MODE   = 'Cannot change mode for [%1$s] - %2$s';
	const CANT_CHANGE_OWNER  = 'Cannot change owner for [%1$s] - %2$s';
	const CANT_EXEC_AS_USER  = 'Cannot execute the command [%1$s] as user [%2$s] - %3$s';
	const ERROR_RUNNING_SCRIPT = 'Cannot run script file [%1$s] - %2$s';
	const CANT_EXECUTE = 'Cannot execute command [%1$s] as [%2$s] - %3$s';
	
	// svn related
	const CANT_CHECKOUT = 'Error checking out from repository [%1$s] to destination [%2$s] as user [%3$s] - %4$s';

	// environment related
	const OS_NOT_SUPPORTED = 'Your OS: [%1$s] is not supported for this feature';

	// database related
	const CANT_CONNECT_DB   = 'Cannot connect to host [%1$s] as [%2$s] - %3$s';
	const CANT_CREATE_DB    = 'Cannot create database [%1$s] on host [%2$s] -  %3$s';
	const CANT_FIND_DB      = 'Database %1$s does not exist.';
	const ERROR_WITH_SQL_SCRIPT = 'Error executing SQL script from file [%1$s] on database [%2$s] as user [%3$s] - %4$s';
	const ERROR_WITH_SQL_QUERY = 'Error executing SQL query on host [%1$s] as user [%2$s] - %3$s';
}


