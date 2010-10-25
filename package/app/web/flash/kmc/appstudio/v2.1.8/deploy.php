<?php
/**
 * to get example code for kmc wrapper add:
 *  --include-code
 */

define ('SEARCH_BY_TAG_FUNCTION_NAME', 'find_confs_by_usage_tag');

$code = array();
$kcw_for_editors = array();
$kdp_for_studio = array();
$exlude_tags_from_code = array('uploadforkae', 'uploadforkse',);

error_reporting(0);
if(strpos($argv[1],'--ini=') && file_exists(str_replace('--ini=', '', $argv[1]))) $config_path = str_replace('--ini=', '', $argv[1]);
elseif(strpos($argv[2],'--ini=') && file_exists(str_replace('--ini=', '', $argv[2]))) $config_path = str_replace('--ini=', '', $argv[2]);
elseif(strpos($argv[3],'--ini=') && file_exists(str_replace('--ini=', '', $argv[3]))) $config_path = str_replace('--ini=', '', $argv[3]);
else $config_path = 'config.ini';
$confObj = init($config_path);
$kclient = getClient($confObj);
if($argv[1] == '--include-code')
  $includeCode = true;
else
  $includeCode = false;
  
if($argv[1] == '--no-create' || $argv[2] == '--no-create')
  $skipAddUiconf = true;
else
  $skipAddUiconf = false;

$baseTag = $confObj->general->component->name;
$defaultTags = "autodeploy, {$baseTag}_{$confObj->general->component->version}";
$sections = explode(',', $confObj->general->component->required_widgets);

if($includeCode)
{
  $code[] = '$c = new Criteria();';
  $code[] = '$c->addAnd(UiConfPeer::PARTNER_ID, '.$confObj->statics->partner_id.');';
  $code[] = '$c->addAnd(UiConfPeer::TAGS, "%'.$baseTag.'_".$this->kmc_'.$baseTag.'_version."%", Criteria::LIKE);';
  $code[] = '$c->addAnd(UiConfPeer::TAGS, "%autodeploy%", Criteria::LIKE);';
  $code[] = '$this->confs = UiConfPeer::doSelect($c);';
}

$tags_search = array();
foreach($sections as $section)
{
  $sectionName	= trim($section);
  $sectionBase	= $sectionName.'s';
  $baseSwfUrl	= $confObj->$sectionName->$sectionBase->swfpath;
  $swfName	= $confObj->$sectionName->$sectionBase->swfname;
  $objType	= $confObj->$sectionName->$sectionBase->objtype;
  
  echo "creating uiconfs from section $sectionBase with default values ( $baseSwfUrl , $swfName , $objType )".PHP_EOL;
  $num = 1;
  while(isset($confObj->$sectionName->$sectionBase->{$sectionName.$num}))
  {
    echo "{$sectionName}{$num} , $baseSwfUrl , $swfName , $objType".PHP_EOL;
    $configObj = $confObj->$sectionName->$sectionBase->{$sectionName.$num};
    $tags_search[$configObj->usage] = $configObj->usage;
    $uiconf = populate_uiconf_from_config($configObj, $baseSwfUrl, $swfName, $objType);
    if($uiconf)
    {
      $uiconf_id = add_ui_conf($kclient, $uiconf);
      if($configObj->usage == 'uploadforkae' || $configObj->usage == 'uploadforkse')
      {
	$kcw_for_editors[$configObj->identifier] = $uiconf_id;
      }
      if($configObj->usage == 'template_uiconf_for_appstudio')
      {
        $kdp_for_studio[$configObj->identifier] = $uiconf_id;
      }
    }
    else
    {
      echo "failed to create uiconf object ({$sectionBase}: {$sectionName}{$num}) due to missing values. check your config.ini".PHP_EOL;
    }
    $num++;
  }
  
  echo PHP_EOL;
}


if($includeCode)
{
  foreach($tags_search as $tag)
  {
    if(in_array($tag, $exlude_tags_from_code)) continue;
    $code[] = '$this->'.$baseTag.'_uiconfs_'.$tag.' = $this->'.SEARCH_BY_TAG_FUNCTION_NAME.'("'.$baseTag.'_'.$tag.'");';
  }
  echo PHP_EOL.'// code for KMC wrapper'.PHP_EOL;
  $code[] = add_search_conf_by_tag_code();
  echo implode(PHP_EOL, $code);
}

function getClient($configObj)
{
  require_once('KalturaClient.php');  
  
  $kconf = new KalturaConfiguration($configObj->statics->partner_id);
  $kconf->serviceUrl = $configObj->statics->service_url;
  $kclient = new KalturaClient($kconf);
  $kclient->setKs($kclient->session->startLocal($configObj->statics->admin_secret, "", 2));
  
  return $kclient;
}
function init($conf_file_path)
{
  $conf = parse_ini_file($conf_file_path, true);
  require_once($conf['statics']['infra_path'].DIRECTORY_SEPARATOR."bootstrap_base.php");
  require_once(KALTURA_INFRA_PATH.DIRECTORY_SEPARATOR."KAutoloader.php");
  KAutoloader::setIncludePath(array(KAutoloader::buildPath(KALTURA_ROOT_PATH, "vendor", "ZendFramework", "library"),));
  KAutoloader::register();
  
  $confObj = new Zend_Config_Ini('config.ini');
  return $confObj;
}
function populate_uiconf_from_config($confConfigObj, $baseSwfUrl, $swfName, $objType)
{
  global $defaultTags, $baseTag, $confObj, $kcw_for_editors, $kdp_for_studio;
  $uiconf = new KalturaUiConf();
  $uiconf->confFile = read_conf_file_from_path($confConfigObj->conf_file);
  if($uiconf->confFile === FALSE)
  {
    return FALSE; // conf file is a must, features is not.
  }
  
  $replace_tag = '';
  if($objType == KalturaUiConfObjType::ADVANCED_EDITOR) $replace_tag = 'uIConfigId';
  if($objType == KalturaUiConfObjType::SIMPLE_EDITOR) $replace_tag = 'UIConfigId';
  if($replace_tag)
  {
    if(isset($confConfigObj->kcw_identifier) && isset($kcw_for_editors[$confConfigObj->kcw_identifier]))
    {
      $pattern = '/<'.$replace_tag.'>(.*)<\/'.$replace_tag.'>/';
      $replacement = "<$replace_tag>{$kcw_for_editors[$confConfigObj->kcw_identifier]}</$replace_tag>";
      $uiconf->confFile = preg_replace($pattern, $replacement, $uiconf->confFile);
    }
  }
  if(isset($confConfigObj->usage) && $confConfigObj->usage == 'templates')
  {
    foreach($kdp_for_studio as $identifier => $confId)
    {
      $uiconf->confFile = str_replace('@@'.$identifier.'@@', $confId, $uiconf->confFile);
    }
  }
  
  $uiconf->confFileFeatures = read_conf_file_from_path($confConfigObj->conf_file, true);
  if($uiconf->confFileFeatures === FALSE) echo "missing features conf file for uiconf {$confConfigObj->name}".PHP_EOL; // conf file is a must, features is not.
  
  $uiconf->partnerId = $confObj->statics->partner_id;
  $uiconf->creationMode = 3;
  $uiconf->useCdn = 1;
  $uiconf->objType = $objType;
  
  $uiconf->name = $confConfigObj->name;
  $uiconf->swfUrl = $baseSwfUrl.$confConfigObj->version.'/'.$swfName;
  $uiconf->tags = $defaultTags.', '.$baseTag.'_'.$confConfigObj->usage;

  $uiconf->width = @$confConfigObj->width;
  $uiconf->height = @$confConfigObj->height;
  $uiconf->confVars = @$confConfigObj->conf_vars;

  return $uiconf;
}

function add_ui_conf($kclient, $pe_conf)
{
  global $skipAddUiconf;
  if($skipAddUiconf) return rand(1000,1200);
  
  try{
    $conf_output = $kclient->uiConf->add($pe_conf);
  }
  catch(Exception $ex)
  {
    echo $ex->getMessage().print_r(@$conf_output,true).PHP_EOL;
    return false;
  }
  echo 'uiconf '.$player.' ID: '.@$conf_output->id.PHP_EOL;
  return $conf_output->id;
}

function read_conf_file_from_path($file_path, $is_features = false)
{
  if($is_features) $file_path = str_replace('.xml', '.features.xml', $file_path);
  if(!file_exists($file_path)) return FALSE;
  
  $file_content = file_get_contents($file_path);
  return $file_content;
}
function get_uiconf_objtype_const_from_number($num)
{
  $reflectionClass = new ReflectionClass('KalturaUiConfObjType');
  $allConsts = $reflectionClass->getConstants();
  $consts = array();
  foreach($allConsts as $key => $value)
  {
    if($value == $num)
      return $key;
  }
  $objType = KalturaUiConfObjType::SIMPLE_EDITOR;
}

function add_search_conf_by_tag_code()
{
  $code[] = '';
  $code[] = 'function '.SEARCH_BY_TAG_FUNCTION_NAME.'($tag)';
  $code[] = '{';
  $code[] = '  $uiconfs = array();';
  $code[] = '  foreach($this->confs as $uiconf)';
  $code[] = '  {';
  $code[] = '    $tags = explode(",", $uiconf->getTags());';
  $code[] = '    $trimmed_tags = $this->TrimArray($tags);';
  $code[] = '    if(in_array($tag, $trimmed_tags)) $uiconfs[] = $uiconf;';
  $code[] = '  }';
  $code[] = '';
  $code[] = '  return $uiconfs;';
  $code[] = '}';
  
  $code[] = '';
  $code[] = 'function TrimArray($arr){';
  $code[] = '  if (!is_array($arr)){ return $arr; }';
  $code[] = '';
  $code[] = '  while (list($key, $value) = each($arr)){';
  $code[] = '    if (is_array($value)){';
  $code[] = '      $arr[$key] = TrimArray($value);';
  $code[] = '    }';
  $code[] = '    else {';
  $code[] = '      $arr[$key] = trim($value);';
  $code[] = '    }';
  $code[] = '  }';
  $code[] = '  return $arr;';
  $code[] = '}';
  
  $codeStr = implode(PHP_EOL, $code);
  return $codeStr;
}
