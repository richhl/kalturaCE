<?php
require_once('kaltura_client_v3/KalturaClient.php');
class KalturaCEErrorReport
{
    public $browser;
    public $serverIp;
    public $serverOS;
    public $phpVer;
    public $kpartnerId;
    public $ceAdminEmail;
    private $shouldReport = false;
    private $foundErrors = array();
    
    function __construct($should_report)
    {
        if ($should_report && $should_report != '' && $should_report == 1)
        {
            $this->shouldReport = true;
        }
        $this->browser = $_SERVER['HTTP_USER_AGENT'];
        $this->serverIp = ($_SERVER['SERVER_NAME'])? $_SERVER['SERVER_NAME']: $_SERVER['SERVER_ADDR'];
        $this->serverOS = $_SERVER['SERVER_SOFTWARE'];
        $this->phpVer = phpversion();
    }
    
    public function addError($type, $description, $data = '')
    {
        if(!$this->shouldReport)
        {
            return;
        }
        $error = new MyKalturaCEError();
        $error->type = $type;
        $error->description = $description;
        $error->data = $data;
        
        $errors = $this->foundErrors;
        $errors[] = $error;
        $this->foundErrors = $errors;
    }
    
    public function sendReport()
    {
        if(!$this->shouldReport)
        {
            return;
        }
        $kceError = new KalturaCEError;
        $kceError->browser = $this->browser;
        $kceError->ceAdminEmail = $this->ceAdminEmail;
        $kceError->partnerId = $this->kpartnerId;
        $kceError->phpVersion = $this->phpVer;
        $kceError->serverIp = $this->serverIp;
        $kceError->serverOs = $this->serverOS;
        if ($this->kpartnerId)
        {
            $config = new KalturaConfiguration($this->kpartnerId);
        }
        else
        {
            $config = new KalturaConfiguration(0);
        }
        $config->serviceUrl = 'http://www.kaltura.com';
        $client = new KalturaClient($config);
        
        foreach($this->foundErrors as $error)
        {
            // send error here
            $kceError->type = $error->type;
            $kceError->description = $error->description;
            $kceError->data = $error->data;            
            try
            {
                $reported_error = $client->stats->reportKceError($kceError);
            }
            catch(Exception $ex)
            {
                // error
            }
        }
    }
    
    public function errorCount()
    {
        return count($this->foundErrors);
    }
}

class MyKalturaCEError
{
    public $type;
    public $description;
    public $data;
    
}
?>