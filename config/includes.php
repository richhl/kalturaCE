<?php

// config files

include_once(dirname(__FILE__).'/defines.php');
include_once(CONFIG_DIR.'error_codes.php');
include_once(CONFIG_DIR.'texts.php');
include_once(CONFIG_DIR.'/prerequisites.php');
include_once(PACKAGE_DIR.'/package_folders.php');


// lib

include_once(LIB_DIR.'InstallStep.class.php');
include_once(LIB_DIR.'CrontabUtils.class.php');
include_once(LIB_DIR.'DatabaseUtils.class.php');
include_once(LIB_DIR.'ErrorObject.class.php');
include_once(LIB_DIR.'FileUtils.class.php');
include_once(LIB_DIR.'InstallReport.class.php');
include_once(LIB_DIR.'InstallUtils.class.php');
include_once(LIB_DIR.'UserInputUtils.class.php');
include_once(LIB_DIR.'myConf.class.php');