<?php
require_once ( "myKshowUtils.class.php");
require_once ( "defPartnerservices2Action.class.php");
require_once ( "myPartnerUtils.class.php");

class getlastversionsinfoAction extends defPartnerservices2Action
{
	public function describe()
	{
		return 
			array (
				"display_name" => "getLastVersionsInfo",
				"desc" => "" ,
				"in" => array (
					"mandatory" => array ( 
						"kshow_id" => array ("type" => "string", "desc" => "")
						)
					),
				"out" => array (
					),
				"errors" => array (
				)
			); 
	}
	
	protected function ticketType ()	{		return self::REQUIED_TICKET_REGULAR;	}

	protected function needKuserFromPuser ( )	
	{	
			return self::KUSER_DATA_NO_KUSER;
	}
	
	public function executeImpl ( $partner_id , $subp_id , $puser_id , $partner_prefix , $puser_kuser )
	{
		$kshowId = $this->getP("kshow_id");
		$numberOfVersions = $this->getP("number_of_versions", 5);
		
		// must be int and not more than 50
		$numberOfVersions = (int)$numberOfVersions;
		$numberOfVersions = min($numberOfVersions, 50);

		$kshow = kshowPeer::retrieveByPK( $kshowId );
		
		if (!$kshow)
		{
			$this->addError(APIErrors::KSHOW_DOES_NOT_EXISTS);
			return;
		}
		
		$showEntry = $kshow->getShowEntry();
		if (!$showEntry)
		{
			$this->addError(APIErrors::ROUGHCUT_NOT_FOUND);
			return;	
		}
		
		$lastVersionFileName 	= $showEntry->getDataPath();
		$versionsInfoFileName 	= $showEntry->getDataPath("info");
		$lastVersionFilePath 	= myContentStorage::getFSContentRootPath() . "/" . $lastVersionFileName;
		$versionsInfoFilePath 	= myContentStorage::getFSContentRootPath() . "/" . $versionsInfoFileName;
		
		$lastVersionDoc = new DOMDocument();
		$lastVersionContent = file_get_contents($lastVersionFilePath);
		$lastVersionDoc->loadXML($lastVersionContent);
		$lastVersion = myContentStorage::getVersion($lastVersionFileName);
		
		// check if we need to refresh the data in the info file
		$refreshInfoFile = true;
		if (file_exists($versionsInfoFilePath))
		{
			$versionsInfoDoc = new DOMDocument();
			$versionsInfoDoc->load($versionsInfoFilePath);
			$lastVersionInInfoFile = kXml::getLastElementAsText($versionsInfoDoc, "ShowVersion");

			if ($lastVersionInInfoFile && $lastVersion == $lastVersionInInfoFile)
				$refreshInfoFile = false;
			else
				$refreshInfoFile = true;
		}
		else
		{
			$refreshInfoFile = true;
		}

		// refresh or create the data in the info file
		if ($refreshInfoFile)
		{
			$versionsInfoDoc = new DOMDocument();
			$xmlElement = $versionsInfoDoc->createElement("xml");
			
			// start from the first edited version (100001) and don't use 100000
			for ($i = myContentStorage::MIN_OBFUSCATOR_VALUE + 1; $i <= $lastVersion; $i++)
			{
				$fullFilePath = myContentStorage::getFSContentRootPath() . "/" . $showEntry->getDataPath($i);
				if (file_exists($fullFilePath))
				{
					$xmlContent = file_get_contents($fullFilePath);
					$xmlDoc = new DOMDocument();
					$xmlDoc->loadXML($xmlContent);
					$elementToCopy = kXml::getFirstElement($xmlDoc, "MetaData");
				
					$elementCloned = $elementToCopy->cloneNode(true);
					
					$elementImported = $versionsInfoDoc->importNode($elementCloned, true);
					
					$xmlElement->appendChild($elementImported);
				}
			}
			$versionsInfoDoc->appendChild($xmlElement);
			kFile::setFileContent($versionsInfoFilePath, $versionsInfoDoc->saveXML());
		}
		
		$metadataNodes = $versionsInfoDoc->getElementsByTagName("MetaData");
		$count = 0;
		$versionsInfo = array();
		for($i = $metadataNodes->length - 1; $i >= 0; $i--)
		{
			$metadataNode = $metadataNodes->item($i);

			$node = kXml::getFirstElement($metadataNode, "ShowVersion");
			$showVersion = $node ? $node->nodeValue : "";

			$node = kXml::getFirstElement($metadataNode, "PuserId");
			$puserId = $node ? $node->nodeValue : "";
			
			$node = kXml::getFirstElement($metadataNode, "ScreenName");
			$screenName = $node ? $node->nodeValue : "";
			
			$node = kXml::getFirstElement($metadataNode, "UpdatedAt");
			$updatedAt = $node ? $node->nodeValue : "";

			$versionsInfo[] = array(
						"version" => $showVersion,
						"puserId" => $puserId,
						"screenName" => $screenName,
						"updatedAt" => $updatedAt,
					);
					
			$count++;

			if ($count >= $numberOfVersions)
				break;
		}
		

		$this->addMsg ( "show_versions" , $versionsInfo );
	}
}
?>